<?php include ('db_connect.php') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
  integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <div class="content-wrapper"> -->


<!-- Info boxes -->
<?php if ($_SESSION['login_type'] == 1): ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $conn->query("SELECT * FROM users where type = 1")->num_rows; ?></h3>

              <p>Total Admin</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user-tie"></i>
            </div>
            <a href="#" class="small-box-footer">Edit Profile <i class="fa-solid fa-pen"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $conn->query("SELECT * FROM users where type = 2")->num_rows; ?></h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-user-group"></i>
            </div>
            <a href="./index.php?page=user_list" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $conn->query("SELECT * FROM documents")->num_rows; ?></h3>

              <p>Total Documents</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-file"></i>
            </div>
            <a href="./index.php?page=document_list" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>
                <?php echo $conn->query("SELECT * FROM documents  where user_id = {$_SESSION['login_id']}")->num_rows; ?>
              </h3>

              <p>Your Uploads</p>
            </div>
            <div class="icon">
              <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php else: ?>
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3><?php echo ucwords($_SESSION['login_firstname'] . ' ' . $_SESSION['login_lastname']) ?></h3>

          <p>User</p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-user-tie"></i>
        </div>
        <a href="#" class="small-box-footer">Edit Profile <i class="fa-solid fa-pen"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3><?php echo $conn->query("SELECT * FROM documents")->num_rows; ?></h3>

          <p>Total Documents</p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-file"></i>
        </div>
        <a href="./index.php?page=document_list" class="small-box-footer">More info <i
            class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>
            <?php echo $conn->query("SELECT * FROM documents  where user_id = {$_SESSION['login_id']}")->num_rows; ?>
          </h3>

          <p>Your Uploads</p>
        </div>
        <div class="icon">
          <i class="fa-solid fa-cloud-arrow-up"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <!-- /.col -->
  </div>

<?php endif; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong> Latest Posts </strong></h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0" style="height: 250px;">
        <table class="table table-head-fixed text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Post By</th>
              <th>Date</th>
            </tr>
          </thead>
          <?php
      $i = 1;
      $user = $conn->query("SELECT * FROM users where id in (SELECT user_id FROM documents) ");
      while ($row = $user->fetch_assoc()) {
        $uname[$row['id']] = ucwords($row['firstname'] . ' ' . $row['middlename'] . ' ' .$row['lastname']);
      }
      $qry = $conn->query("SELECT * FROM documents order by unix_timestamp(date_created) desc limit 5");
      while ($row = $qry->fetch_assoc()):
      $count = 0;
      ?>
          <tbody>
            <tr>
              <td><?= $i++; ?></td>
              <td><?php echo ucwords($row['title']) ?></td>
              <td><?php echo isset($uname[$row['user_id']]) ? $uname[$row['user_id']] : "Deleted User" ?></td>
              <!-- <td><?= $data['firstname']. ''.$data['middlename'] .''.$data['lastname'] ?></td> -->
              <td><?php echo ucwords($row['date_created']) ?> <p class="badge badge-danger"> New</p></td>
            </tr>
          </tbody>
          <?php
          $count++;
        //  }
      endwhile;
         if($i == 0){?>
         <td colspan="4" align="center">Currently, there is no posts.....</td>
         <?php }?>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
</div>