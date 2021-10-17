<?php include 'userhead.php'; ?>
<!-- End of Topbar -->
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Content Row -->
  <!-- Content Row -->
  <div class="row">
    <!-- Content Column -->
    <h6 class="m-2 font-weight-bold text-primary">Manage Publications</h6>
    <div class="col-lg-12 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#mediumModal">
            <span class="icon text-white-50">
              <i class="fas fa-flag"></i>
            </span>
            <span class="text">New Publication</span>
          </a>
          <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#mediumModal1">
            <span class="icon text-white-50">
              <i class="fas fa-arrow-right"></i>
            </span>
            <span class="text">Add a Genre</span>
          </a>
        </div>
        <div class="card-body">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Publications</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Genre</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <?php  
              $nums = json_decode(publications());
              $genre = json_decode(genre());
              if (!empty($nums)) {
                ?>
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Document Name</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>approve</th>
                        <th>delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <form>
                        <?php 
                        $j = 1;
                        foreach ($nums as $user) {
                          $name = json_decode($user->book);
                          $c = explode('/', $name->src);
                          $e = $c[1];
                          ?>
                          <tr>
                            <td><?=$e?></td>
                            <td><input type="text" name="" class="form-control" id="title" value="<?php if (!empty($user->title)){echo $user->title;}else{echo "not set";}?>"></td>
                            <td><input type="text" name="" class="form-control" id="author" value="<?php if (!empty($user->author)){echo $user->author;}else{echo "not set";}?>"></td>
                            <td>
                              <select class="custom-select" id="genreselector<?=$j?>">
                                <option>Select a genre</option>
                                <?php
                                if (!empty($genre)) {
                                  foreach ($genre as $key) {
                                    ?>
                                    <option value="<?=$key->id?>"><?=$key->genre?></option>
                                  <?php }}?>
                                </select>
                                <td><a href="#" style="color: green" onclick="updateBookDetails('<?=$user->id?>', 'genreselector<?=$j?>')"><i class="fa fa-check"></i></a></td>
                                <td><a href="#" style="color: red" onclick="deleteBook('<?=$user->id?>')"><i class="fa fa-trash"></i></a></td>
                              </tr>
                              <?php $j++;} ?>
                            </form>
                          </tbody>
                        </table>
                      </div>
                    <?php }else{ ?>
                      <p class="text-center"><span>There are currently no publications added<br><img src="../images/empty.png" class="img-fluid"></span></p>
                    <?php } ?>
                  </div>
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <?php  
                    $nums = json_decode(genre());
                    if (!empty($nums)) {
                      ?>
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>Genre</th>
                              <th>Edit</th>
                              <th>delete</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            foreach ($nums as $user) {
                              ?>
                              <tr>
                                <td><?=$user->genre?></td>
                                <td><a href="edit_genre.php?id=<?=$user->id?>" style="color: green"><i class="fa fa-pencil"></i></a></td>
                                <td><a href="#" style="color: red" onclick="deleteGenre('<?=$user->id?>')"><i class="fa fa-trash"></i></a></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    <?php }else{ ?>
                      <p class="text-center"><span>There are currently no publications added<br><img src="../images/empty.png" class="img-fluid"></span></p>
                    <?php } ?>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mediumModalLabel">Medium Modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-10 offset-lg-2">
                <div id="body-overlay"><div><img src="images/loading.gif" width="64px" height="64px"/></div></div>
                <div class="bgColor">
                  <form id="uploadForm" action="upload.php" method="post">
                    <div id="targetOuter">
                      <div id="targetLayer"></div>
                      <img src="images/photo.png"  class="icon-choose-image" />
                      <div class="icon-choose-image" >
                        <input name="customFile" id="customFile" type="file" class="inputFile" onChange="showPreview(this);" />
                      </div>
                    </div>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="inpfile" name="inpfile">
                      <label class="custom-file-label" for="inpfile">Upload a Document</label>
                    </div>
                    <div>
                      <input type="submit" value="Upload Photo" class="btnSubmit m-2"/>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="mediumModal1" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel1" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mediumModalLabel1">Medium Modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <form id="uploadForm1" action="upload.php" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Genre</label>
                    <input type="text" class="form-control" id="genreselect" aria-describedby="emailHelp" placeholder="Enter Genre">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Main Content -->
    <?php include 'userfoot.php'; ?>