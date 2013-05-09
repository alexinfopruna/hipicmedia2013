<?php
$block = module_invoke('block','block_view','37');
print render($block['content']);    
?>