 
  <h2><button type="button" class="btn btn-primary">Categories</button></h2>           
  <table class="table table-hover">
    <tbody>
           <?php 

        $sql="SELECT * from tbl_category";

        $records_per_page=5;
        $newquery = $objCrud->paging($sql,$records_per_page);
        $objCrud->category($newquery);
         // $crud->getBlog($sql);
  ?>
    </tbody>
  </table>
