<?php 
    include('sidebar.php');
    $param_id = $_GET['id'];
    $rs = connection()->query("SELECT * FROM `tbl_logo` WHERE `id`= '$param_id'");
    $row = mysqli_fetch_assoc($rs);
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                   
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-select" name="status">
                                            <option value="Header"<?php echo($row['status']=="Header") ? 'Selecte':'' ?>>Header</option>
                                            <option value="Footer" <?php echo($row['status']=="Footer") ? 'Selecte':'' ?>>Footer</option>
                                        </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label>thumbnail <span class="text-danger">Recommend size(216px x 50)</span></label>
                                        <input type="file" name="thumbnail" lass="form-control">
                                        <input type="text" name="old_thumbnail" value="<?php echo $row['thumbnail'] ?>" id="">
                                        <img class="mt-3" src="assets/Adminthumbnail/<?php echo $row['thumbnail'] ?>" alt="" width="150px">
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="submit" name="btn-update-logo" class="btn btn-primary">Update</button>
                                        
                                    </div>
                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>