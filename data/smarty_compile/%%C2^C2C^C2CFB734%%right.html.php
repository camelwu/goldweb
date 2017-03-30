<?php /* Smarty version 2.6.20, created on 2017-03-12 23:01:46
         compiled from D:%5Clocal%5Cgoldweb/view/common/right.html */ ?>
<!--热门推荐-->
<ul class="sidebar_box" style="right: 0px;">
	<?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['rtours']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
    <?php if ($this->_sections['n']['index'] == 0): ?><li class="last_sidebar"><?php else: ?><li><?php endif; ?>
        <a href="/tours/<?php echo $this->_tpl_vars['rtours'][$this->_sections['n']['index']]['id']; ?>
" target="_blank"><img src="<?php echo $this->_tpl_vars['rtours'][$this->_sections['n']['index']]['url']; ?>
" height="100%"></a>
        <ul class="sidebar_bg" style="display: none; opacity: 1;">
            <li class="sid_img"><a href="/tours/<?php echo $this->_tpl_vars['rtours'][$this->_sections['n']['index']]['id']; ?>
" target="_blank"><img src="<?php echo $this->_tpl_vars['rtours'][$this->_sections['n']['index']]['url']; ?>
" height="100%"></a></li>
            <li class="sid_txt"><a href="/search/<?php echo $this->_tpl_vars['rtours'][$this->_sections['n']['index']]['departure']; ?>
" target="_blank"><?php echo $this->_tpl_vars['rtours'][$this->_sections['n']['index']]['departure']; ?>
</a>▪<a href="/search/<?php echo $this->_tpl_vars['rtours'][$this->_sections['n']['index']]['city2']; ?>
"><?php echo $this->_tpl_vars['rtours'][$this->_sections['n']['index']]['city2']; ?>
</a></li>
        </ul>
    </li><?php endfor; endif; ?>
    
    <div class="hui_top" style="right: 1px;"></div>
</ul>