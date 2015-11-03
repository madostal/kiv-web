<html>
<body>
<table>

{foreach from=$pole key=key item=value}
  <tr><td>{$key}</td><td>{$value}</td></tr>
{/foreach}

{foreach from=$smarty.server key=key item=value}
  <tr><td>{$key}</td><td>{$value}</td></tr>
{/foreach}

</table>

</body>
</html>
