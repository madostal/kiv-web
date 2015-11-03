<?php /* Smarty version 2.6.18, created on 2008-09-22 12:09:00
         compiled from env.tpl */ ?>
<html>
<body>
<table>

<?php $_from = $this->_tpl_vars['pole']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
  <tr><td><?php echo $this->_tpl_vars['key']; ?>
</td><td><?php echo $this->_tpl_vars['value']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>

<?php $_from = $_SERVER; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
  <tr><td><?php echo $this->_tpl_vars['key']; ?>
</td><td><?php echo $this->_tpl_vars['value']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>

</table>

</body>
</html>