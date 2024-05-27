<?php 
    include('sidebar.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>FOLLOW TO US</h3>
                        </div>
                        <div class="bottom">
                            <figure> 
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>NAME URL</label>
                                        <input type="text" name="label" id="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">URL <span class="text-danger" style="font-size:13px;">Please. Enter link url: Facebook TikTok YouTube Telegram Instagram ...</span></label>
                                        <textarea name="url" id="" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>STATUS</label>
                                        <select class="form-select" name="Status">
                                            <option value="">CHOOSE</option>
                                            <option value="HEADER">HEADER</option>
                                            <option value="FOOTER">FOOTER </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>THUMBNAIL <span class="text-danger" style="font-size:13px;">Recommend use logo size 216px X 50px </span></label>
                                        <input type="file" name="thumbnail" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="btn-add-follow" class="btn btn-primary">Follow</button>
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