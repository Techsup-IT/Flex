<div id="content-container">
          <div class="pageheader hidden-xs">
                        <h3><i class="fa fa-home"></i>Timenox Updates</h3>
                        <div class="breadcrumb-wrapper">
                            <span class="label">You are here:</span>
                            <ol class="breadcrumb">
                                <li> <a href="<?php echo $link->link('home',frontend);?>">Dashboard</a> </li>
                                <li class="active">Timenox Update</li>
                            </ol>
                        </div>
                    </div>
                    <div id="page-content">
                        <div class="row">
                        <?php echo $updm;?>
                         <?php echo $display_msg;?>
                        </div>
                        <div class="row">    <div class="eq-height">
                                <div class="col-sm-12 eq-box-sm">
                                    <div class="panel">
                                      <div class="panel-heading">
                                       <div class="panel-control">
                                                <button class="btn btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></button>
                                                <button class="btn btn-default" data-click="panel-reload"><i class="fa fa-refresh"></i></button>
                                                <button class="btn btn-default" data-click="panel-collapse"><i class="fa fa-chevron-down"></i></button>
                                                <button class="btn btn-default" data-dismiss="panel"><i class="fa fa-times"></i></button>
                                            </div>
                                            <h3 class="panel-title">Choose File</h3>
                                        </div>
                                     <form enctype="multipart/form-data" method="post" action="">
                                       <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                          <div class="form-group">
                                                           <label class="control-label">Choose File to upload</label>
                                                       <div class="fileupload fileupload-new" data-provides="fileupload">
										                  <div>
										                <br>
										                 <input type="file" name="fileToUpload" />
										                  </div>
								                        <br />
                                                   <input class="btn btn-block btn-success" type="submit" name="submit" value="Upload" />
								              </div>
                                                 </div></div>
                                                </div>
                                            </div>
                                         </form>
                                        </div>
                                        
                                       
                                </div>

                            </div>
                        </div>
                         <div class="row">
                         <a href="#" class="list-group-item active">
                                                <h4 class="list-group-item-heading">Important note</h4>
                                                <p class="list-group-item-text">You will receive automatic notification, once updates are released !. You can download those updates and upload here to upgrade your TimeNox.</p>
                                            </a>
                                            </div>

                    </div>
              </div>
