<?php 
    include('sidebar.php');
    $param_id = $_GET['id'];
    $rs = connection()->query("SELECT * FROM `tbl_follow` WHERE `id` = '$param_id'");
    $row = mysqli_fetch_assoc($rs);
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>FOLLOE TO US</h3>
                        </div>
                        <div class="bottom">
                            <figure> 
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>NAME URL</label>
                                        <input type="text" name="label" id="" value= "<?php echo $row['label']?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">URL <span class="text-danger" style="font-size:13px;">Please. Enter link url: Facebook TikTok YouTube Telegram Instagram ...</span></label>
                                        <textarea name="url" id="" cols="30" rows="3" class="form-control"><?php echo $row['url']?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>STATUS</label>
                                        <select class="form-select" name="status">
                                            <option value="">CHOOSE</option>
                                            <option value="HEADER" <?php echo ($row['status'] == "HEADER") ? 'Selected' : '' ?>>HEADER</option>
                                            <option value="FOOTER" <?php echo ($row['status'] == "FOOTER") ? 'Selected' : '' ?>>FOOTER </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>THUMBNAIL <span class="text-danger" style="font-size:13px;">Recommend use logo size 216px X 50px </span></label>
                                        <input type="file" name="thumbnail" class="form-control">
                                        <input type="hidden" name="old_thumbnail" value="<?php echo $row['thumbnail']?>">
                                        <div class="img mt-3" style="width:200px; height:200px;">
                                            <img src="assets/image/<?php echo $row['thumbnail']?>" style="width: 100%; object-fit: cover; height:100%;" alt="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-update-follow" class="btn btn-primary">UPDATE</button>
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