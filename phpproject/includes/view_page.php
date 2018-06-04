     <?php 
      if(@$_GET['cat']<>""){
        $sql="SELECT * from tbl_product where cat_id=".@$_GET['cat'];

      }else{
        $sql="SELECT * from tbl_product";

      }

        $records_per_page=3;
        $newquery = $objCrud->paging($sql,$records_per_page);
        $objCrud->getProduct($newquery);
         // $crud->getBlog($sql);
  ?>
    


       </div>      
     <!—- Pagination -—>
      <ul class="pagination justify-content-center mb-4">
        <?php $objCrud->paginglink($sql,$records_per_page); ?>
      </ul>
     <!-- -->