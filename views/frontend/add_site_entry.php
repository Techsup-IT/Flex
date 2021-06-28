
<div id="content-container">
          <div class="pageheader hidden-xs">
                        <h3><i class="fa fa-tags"></i>Add Site Entry</h3>
                        <div class="breadcrumb-wrapper">
                            <span class="label">You are here:</span>
                            <ol class="breadcrumb">
                                <li> <a href="<?php echo $link->link('site_setting#tab2',frontend);?>">Site Entry </a> </li>
                                <li class="active">Add Site entry</li>
                            </ol>
                        </div>
                    </div>
                    <div id="page-content">
                        <div class="row">
                         <?php echo $display_msg;?>
                            <div class="eq-height">
                                <div class="col-sm-12 eq-box-sm">
                                    <div class="panel">
                                      <div class="panel-heading">
                                       <div class="panel-control">
                                                <button class="btn btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></button>
                                                <button class="btn btn-default" data-click="panel-reload"><i class="fa fa-refresh"></i></button>
                                                <button class="btn btn-default" data-click="panel-collapse"><i class="fa fa-chevron-down"></i></button>
                                                <button class="btn btn-default" data-dismiss="panel"><i class="fa fa-times"></i></button>
                                            </div>
                                            <h3 class="panel-title">Add New Site</h3>
                                        </div>
                                     <form method="post" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                                    
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                      <div class="text-left">
					                                    <label class="text-muted">Site Title</label>
					                                   <input class="form-control" type="text" placeholder="Enter your project title *" name="site_title">
					                                </div>
					                                </div>
					                                
                                                </div>
					                            
                                                  
                                                     <div class="col-sm-1"></div>
                                                       <div class="col-sm-5">
                                                       
				                                       
                                               <div class="form-group">
                                                      <div class="text-left">
					                                    <label class="text-muted">Site URL/Keyword</label>
					                                   <input class="form-control" type="text" placeholder="Enter your site url/keyword *" name="site_url">
					                                </div>
					                                </div>
                                                    
                                                    <div class="form-group">
                                              
                                            </div>
                                                    
                                                    
                                                </div>
                                            </div>
                                            <div class="panel-footer text-right">
                                                <button class="btn btn-info" type="submit" name="submit_add_site_entry">Submit</button>
                                            </div>
                                            </div>
                                        </form>
                                        </div>
                                </div>

                            </div>
                        </div>

                    </div>
</div>
