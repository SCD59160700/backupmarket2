<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Market</title>

  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

 
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0 ">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                <div class="col-lg-7 mx-auto">
                  <div class="p-5 ">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">เพิ่มข้อมูล</h1>
                    </div>
                    <form class="user" action="code/supadm_form_add_db.php" method="POST">
                      <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">

                          <input name="username" type="text" class="form-control form-control"  placeholder="username">
                        </div>
                        <div class="col-sm-6">
                          <input name="password" type="password" class="form-control form-control"  placeholder="password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <input name="firstname" type="text" class="form-control form-control"  placeholder="firstname">
                        </div>
                        <div class="col-sm-6">
                          <input name="lastname" type="text" class="form-control form-control"  placeholder="lastname">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="email" type="email" class="form-control form-control"  placeholder="email">
                      </div>
                      <div class="form-group " >
                        <!-- <div class="col-sm-6 mb-3 mb-sm-0"> -->
                        <input name="tel" type="text" class="form-control form-control"  placeholder="tel">
                        <!-- </div> -->
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-12" align="left">
                          <textarea name="address" class="form-control form-control"  placeholder="Address" ></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-4" align="left">
                        <select name="type" class="form-control" >
                            <option>user</option>
                            <option >admin</option>
                            <option >superadmin</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-4" align="left">
                        <select name="status" class="form-control" >
                            <option >active</option>
                            <option >inactive</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                          <div class="col-sm-2 ml-auto" align="right"> </div>
                          <div class="col-sm-6 ml-auto" align="right">
                            <button type="submit" class="btn btn-success" id="btn"><span class="glyphicon glyphicon-ok"></span> เพิ่ม </button>
                            <button type="submit" class="btn btn-primary" id="btnBack" formaction="superadm_list2.php">ย้อนกลับ</button>
                          </div>
                        </div>
            
                      
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
    
  
</body>

</html>