<?php
/**
 * @file
 * Default cache implementation.
 *
 * This is Drupal's default cache implementation. It uses the database to store
 * cached data. Each cache bin corresponds to a database table by the same name.
 */
class CacheGraceful extends DrupalDatabaseCache {
  protected $locks = array();

  protected function prepareItem($cache) {
    if ($this->hasExpired($cache)) {
      return FALSE;
    }
    return parent::prepareItem($cache);
  }

  function set($cid, $data, $expire = CACHE_PERMANENT) {
    if (empty($cid)) return;
    parent::set($cid, $data, $expire);
    if (!empty($this->locks[$cid])) {
      unset($this->locks[$cid]);
      try {
        lock_release("cache:$this->bin:$cid");
      }
      catch (Exception $e) {
        // Error releasing lock
      }
    }
  }

  /**
   * Check if object has expired
   * @fixme Smelly code: Also sets a lock. Doesn't quite fit the name hasExpired().
   */
  function hasExpired($cache) {
    if (empty($cache->cid)) return TRUE;

    if ($cache->expire > 0 && $cache->expire < time()) {
      try {
        // Expired
        if  (lock_acquire("cache:$this->bin:$cache->cid")) {
          // Got lock, assuming caller will fill cache.
          $this->locks[$cache->cid] = TRUE;;
          return TRUE;
        }
        else {
          // Stale
          return FALSE;
        }
      }
      catch (Exception $e) {
        // Couldn't lock
        return TRUE;
      }
    }
  }

  function clear($cid = NULL, $wildcard = FALSE) {
    global $user;

    if (empty($cid)) {
      if (variable_get('cache_lifetime', 0)) {
        // We store the time in the current user's $user->cache variable which
        // will be saved into the sessions bin by _drupal_session_write(). We then
        // simulate that the cache was flushed for this user by not returning
        // cached data that was cached before the timestamp.
        $user->cache = REQUEST_TIME;

        $cache_flush = variable_get('cache_flush_' . $this->bin, 0);
        if ($cache_flush == 0) {
          // This is the first request to clear the cache, start a timer.
          variable_set('cache_flush_' . $this->bin, REQUEST_TIME);
        }
        elseif (REQUEST_TIME > ($cache_flush + variable_get('cache_lifetime', 0))) {
          // Clear the cache for everyone, cache_lifetime seconds have
          // passed since the first request to clear the cache.
          db_delete($this->bin)
            ->condition('expire', CACHE_PERMANENT, '<>')
            ->condition('expire', REQUEST_TIME, '<')
            ->execute();
          variable_set('cache_flush_' . $this->bin, 0);
        }
      }
      else {
        // No minimum cache lifetime, flush all temporary cache entries now.
        db_delete($this->bin)
          ->condition('expire', CACHE_PERMANENT, '<>')
          ->condition('expire', REQUEST_TIME, '<')
          ->execute();
      }
    }
    else {
      if ($wildcard) {
        if ($cid == '*') {
          db_update($this->bin)
            ->fields(array('expire' => REQUEST_TIME))
            ->execute();
        }
        else {
          db_update($this->bin)
            ->fields(array('expire' => REQUEST_TIME))
            ->condition('cid', db_like($cid) . '%', 'LIKE')
            ->execute();
        }
      }
      elseif (is_array($cid)) {
        // Delete in chunks when a large array is passed.
        do {
          db_update($this->bin)
            ->fields(array('expire' => REQUEST_TIME))
            ->condition('cid', array_splice($cid, 0, 1000), 'IN')
            ->execute();
        }
        while (count($cid));
      }
      else {
        db_update($this->bin)
          ->fields(array('expire' => REQUEST_TIME))
          ->condition('cid', $cid)
          ->execute();
      }
    }
  }
}
