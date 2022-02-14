<?php 
global $adapter;
$categories = $adapter->fetchAll("SELECT name,path FROM categories");

?>

<html>
    <body>
<form id="category_form" method="post" action="index.php?c=categories&a=save">

  <table border="1" width="100%" cellspacing="4">
    <tr>
      <td colspan="2">Add Category:</td>
    </tr>
    <tr>
      <td width="10%">Parent Id</td>
      <td>
      <select name="category[parentName]">
       <option value="0">Parent Category</option> 
        <?php
        if(!$categories): 
          echo 'No data';
        endif;
          foreach($categories as $category) :?>
            <?php
            
            echo "<option value='".$category['name']."'>".$this->path($category['path'])."</option>" ;
          endforeach;
        ?>
      </select>
      </td>
    </tr>
    <tr>
      <td width="10%">Category Name</td>
      <td><input type="text" name="category[name]" ></td>
    </tr>
    <tr>
      <td width="10%">Status</td>
      <td>
        <select name="category[status]" > 
          <option value="1">Active</option>
          <option value="2">Inactive</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><button type="submit" >Add</button>
          <button ><a href="index.php?c=Category&a=grid">Cancel</a></button></td>
    </tr>
  </table>  

</form>
</body>
</html>


