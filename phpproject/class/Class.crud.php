<?php
class crud
{
  private $db;  
  function __construct($DB_con)
  {
    $this->db = $DB_con;
  }  
  public function create($first_name,$last_name,$email_id,$contact_no)
  {
    try
    {
      $stmt = $this->db->prepare("INSERT INTO tbl_users(first_name,last_name,email_id,contact_no) VALUES(:first_name, :last_name, :email_id, :contact_no)");
      $stmt->bindparam(":first_name",$first_name);
      $stmt->bindparam(":last_name",$last_name);
      $stmt->bindparam(":email_id",$email_id);
      $stmt->bindparam(":contact_no",$contact_no);
      $stmt->execute();
      return true;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();  
      return false;
    }
    
  }
  
public function SaveToCart($ip,$pro_id, $product,$qty, $unit_price,$discount,$amount,$image)
  {
    try
    {
      $stmt = $this->db->prepare("INSERT INTO cart(ip,pro_id, product,qty, unit_price,discount,amount,image) VALUES(:ip,:pro_id, :product,:qty,:unit_price,:discount,:amount,:image)");
      $stmt->bindparam(":ip",$ip);
      $stmt->bindparam(":pro_id",$pro_id);
      $stmt->bindparam(":product",$product);
      $stmt->bindparam(":qty",$qty);
      $stmt->bindparam(":unit_price",$unit_price);
      $stmt->bindparam(":discount",$discount);
       $stmt->bindparam(":amount",$amount);
        $stmt->bindparam(":image",$image);
      $stmt->execute();
      return true;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();  
      return false;
    }
    
  }

  // Update Cart
  public function updateCart($ip,$pro_id,$qty, $unit_price,$amount)
  {
    try
    {
      $stmt=$this->db->prepare("UPDATE cart SET qty=:qty,amount=:amount
                          WHERE pro_id=:pro_id AND ip=:ip ");
      $stmt->bindparam(":qty",$qty);
      $stmt->bindparam(":amount",$amount);     
      $stmt->bindparam(":pro_id",$pro_id);
      $stmt->bindparam(":ip",$ip);
      $stmt->execute();
      
      return true;  
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();  
      return false;
    }
  }

  // View Cart
  public function viewCart($query)
  {
    $stmt = $this->db->prepare($query);
    $stmt->execute();
  
    if($stmt->rowCount()>0)
    {
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
        ?>  
        <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="image/<?php echo $row['image']; ?>" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?php echo $row['product']; ?></a></h4>
                                <h5 class="media-heading"> by <a href="#">Brand name</a></h5>
                                <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                            </div>
                        </div>
                     </td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $row['total_qty']; ?>">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo $row['unit_price']; ?></strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo $row['unit_price']*$row['total_qty']; ?></strong></td>
                        <td class="col-sm-1 col-md-1">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button></td>
                    </tr>

          <?php
      }
      ?>
       <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>$24.59</strong></h5></td>
                    </tr>

      <?php
    }
    else
    {
      ?>
            
            <p>No Data..</p>
            
            <?php
    }
    
  }



  public function getID($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM tbl_users WHERE id=:id");
    $stmt->execute(array(":id"=>$id));
    $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
    return $editRow;
  }

// function Check Exist Cart
   public function checkExistCart($query)
  {
    $stmt = $this->db->prepare($query);
    $stmt->execute();  
    if($stmt->rowCount()>0)
    {
      echo 'taken';
    }
    else
    {
      echo 'not_taken';
    }    
  }




  public function getID_Detail($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM blog WHERE id=:id");
    $stmt->execute(array(":id"=>$id));
    $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
    return $editRow;
  }


  
  public function update($id,$first_name,$last_name,$email_id,$contact_no)
  {
    try
    {
      $stmt=$this->db->prepare("UPDATE tbl_users SET first_name=:first_name, 
                                                   last_name=:last_name, 
                             email_id=:email_id, 
                             contact_no=:contact_no
                          WHERE id=:id ");
      $stmt->bindparam(":first_name",$first_name);
      $stmt->bindparam(":last_name",$last_name);
      $stmt->bindparam(":email_id",$email_id);
      $stmt->bindparam(":contact_no",$contact_no);
      $stmt->bindparam(":id",$id);
      $stmt->execute();
      
      return true;  
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();  
      return false;
    }
  }
  
  public function delete($id)
  {
    $stmt = $this->db->prepare("DELETE FROM tbl_users WHERE id=:id");
    $stmt->bindparam(":id",$id);
    $stmt->execute();
    return true;
  }

/* get Maketing */
  public function getProduct($query)
  {
    $stmt = $this->db->prepare($query);
    $stmt->execute();
  
    if($stmt->rowCount()>0)
    {
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
        ?>
      
          <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="detail.php?p=<?php echo $row['pro_id'] ?>"><img class="card-img-top" src="./image/<?php print($row['picture']); ?>" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="detail.php?p=<?php echo $row['pro_id'] ?>"><?php print($row['pro_name']); ?></a>
                  </h4>
                </div>
                <div class="card-footer">
                   <b>$<?php print($row['price']); ?></b>
                  <button class="btn btn-primary pull-right"><i class="fa fa-cart"></i> Add​ to cart</button>
                </div>
              </div>
            </div>


          <?php
      }
    }
    else
    {
      ?>
            
            <p>No Data..</p>
            
            <?php
    }
    
  }
  //Category
  public function category($query)
  {
    $stmt = $this->db->prepare($query);
    $stmt->execute();
  
    if($stmt->rowCount()>0)
    {
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
        ?>  
        <tr>
            <td><a href="index.php?cat=<?php echo $row['cat_id'] ?>"><?php print($row['categorys']); ?></a></td>
        </tr>

          <?php
      }
    }
    else
    {
      ?>
            
            <p>No Data..</p>
            
            <?php
    }
    
  }
  //End Category
// Get IP
  function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

  //view detail
  public function view_detail($query)
  {
    $stmt = $this->db->prepare($query);
    $stmt->execute();
  
    if($stmt->rowCount()>0)
    {
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {


        $ip=$this->getRealIpAddr();
        $pro_id=$row['pro_id'];
        $product=$row['pro_name'];
        $qty=1;
        $unit_price=$row['price'];
        $discount=$row['discount'];
        $amount=($unit_price-(($unit_price*$discount)/100));
        $image=$row['picture'];

        ?>

<form>

<input type="hidden" name="ip" id="ip" value="<?php echo $ip; ?>">
<input type="hidden" name="pro_id" id="pro_id" value="<?php echo $pro_id; ?>">
<input type="hidden" name="product" id="product" value="<?php echo $product; ?>">
<input type="hidden" name="qty" id="qty" value="<?php echo $qty; ?>">
<input type="hidden" name="unit_price" id="unit_price" value="<?php echo $unit_price; ?>">
<input type="hidden" name="discount" id="discount" value="<?php echo $discount; ?>">
<input type="hidden" name="amount" id="amount" value="<?php echo $amount; ?>">
<input type="hidden" name="image" id="image" value="<?php echo $image; ?>">

  
  <div class="card">
<div class="container">
<div class="wrapper row">
  <div class="preview col-md-6">
    
    <div class="preview-pic tab-content">
      <div class="tab-pane active" id="pic-1"><img src="./image/<?php print($row['picture']); ?>" /></div>
      <div class="tab-pane" id="pic-2"><img src="./image/<?php print($row['picture2']); ?>" /></div>
      <div class="tab-pane" id="pic-3"><img src="./image/<?php print($row['picture3']); ?>" /></div>
      <div class="tab-pane" id="pic-4"><img src="./image/<?php print($row['picture4']); ?>" /></div>
      <div class="tab-pane" id="pic-5"><img src="./image/<?php print($row['picture5']); ?>" /></div>
    </div>

    
<ul class="preview-thumbnail nav nav-tabs">
  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="./image/<?php print($row['picture']); ?>" /></a></li>
  <li><a data-target="#pic-2" data-toggle="tab"><img src="./image/<?php print($row['picture2']); ?>" /></a></li>
  <li><a data-target="#pic-3" data-toggle="tab"><img src="./image/<?php print($row['picture3']); ?>" /></a></li>
  <li><a data-target="#pic-4" data-toggle="tab"><img src="./image/<?php print($row['picture4']); ?>" /></a></li>
  <li><a data-target="#pic-5" data-toggle="tab"><img src="./image/<?php print($row['picture5']); ?>" /></a></li>
</ul>
    
  </div>
  <div class="details col-md-6">
    <h3 class="product-title">men's shoes fashion</h3>
    <div class="rating">
      <div class="stars">
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span>
        <span class="fa fa-star"></span>
        <span class="fa fa-star"></span>
      </div>
      <span class="review-no">41 reviews</span>
    </div>
    <p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium cubilia sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p>
    <h4 class="price">current price: <span>$<?php echo $row['price']; ?></span></h4>
    <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
    <h5 class="sizes">sizes:
      <span class="size" data-toggle="tooltip" title="small">s</span>
      <span class="size" data-toggle="tooltip" title="medium">m</span>
      <span class="size" data-toggle="tooltip" title="large">l</span>
      <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
    </h5>
    <h5 class="colors">colors:
      <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
      <span class="color green"></span>
      <span class="color blue"></span>
    </h5>
    <div class="action">
      <button id="button" class="add-to-cart btn btn-default" type="button">add to cart</button>
      <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
    </div>
  </div>
</div>

      </div>
    </div>

</form>




      


          <?php
      }
    }
    else
    {
      ?>
            
            <p>No Data..</p>
            
            <?php
    }
    
  }
  //End view detail
  //pro_detail
 public function pro_detail($query)
  {
    $stmt = $this->db->prepare($query);
    $stmt->execute();
  
    if($stmt->rowCount()>0)
    {
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
        ?>
      
          <div class="col-md-3 col-sm-6">
        <span class="thumbnail">
            <a href="detail.php?p=<?php echo $row['pro_id'] ?>"><img src="./image/<?php print($row['picture']); ?>" alt="">
            </a>
            <div class="ratings">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                </div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
            <hr class="line">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <p class="price">$<?php print($row['price']); ?></p>
              </div>
              <div class="col-md-6 col-sm-6">
                <button class="btn btn-success right" > BUY ITEM</button>
              </div>
              
            </div>
        </span>
      </div>

          <?php
      }
    }
    else
    {
      ?>
            
            <p>No Data..</p>
            
            <?php
    }
    
  }
  //end pro_detail
  /* paging */
  
  public function dataview($query)
  {
    $stmt = $this->db->prepare($query);
    $stmt->execute();
  
    if($stmt->rowCount()>0)
    {
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
        ?>
                <tr>
                <td><?php print($row['id']); ?></td>
                <td><?php print($row['first_name']); ?></td>
                <td><?php print($row['last_name']); ?></td>
                <td><?php print($row['email_id']); ?></td>
                <td><?php print($row['contact_no']); ?></td>
                <td align="center">
                <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
      }
    }
    else
    {
      ?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
    }
    
  }
  
  public function paging($query,$records_per_page)
  {
    $starting_position=0;
    if(isset($_GET["page_no"]))
    {
      $starting_position=($_GET["page_no"]-1)*$records_per_page;
    }
    $query2=$query." limit $starting_position,$records_per_page";
    return $query2;
  }
  
  public function paginglink($query,$records_per_page)
  {
    
    $self = $_SERVER['PHP_SELF'];
    
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    
    $total_no_of_records = $stmt->rowCount();
    
    if($total_no_of_records > 0)
    {
      ?><ul class="pagination"><?php
      $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
      $current_page=1;
      if(isset($_GET["page_no"]))
      {
        $current_page=$_GET["page_no"];
      }
      if($current_page!=1)
      {
        $previous =$current_page-1;
        echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=1'>First</a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$previous."'>Previous</a></li>";
      }
      for($i=1;$i<=$total_no_of_pages;$i++)
      {
        if($i==$current_page)
        {
          echo "<li class='page-item active'><a class='page-link' href='".$self."?page_no=".$i."' style='color:white;'>".$i."</a></li>";
        }
        else
        {
          echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$i."'>".$i."</a></li>";
        }
      }
      if($current_page!=$total_no_of_pages)
      {
        $next=$current_page+1;
        echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$next."'>Next</a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
      }
      ?></ul><?php
    }
  }
  
  /* paging */
  
}