<div class="bg_header" style="background:url('https://source.unsplash.com/category/objects');">
    <div class="icon">
        <span class="fa-stack fa-5x">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-paint-brush fa-stack-1x fa-inverse"></i>
        </span>
    </div>
</div>
<div class="row">
    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center">Add a new project</h1>
            <form class="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Title</label>
                    <input class="form-control" type="text" name="project_title">
                </div>
                <div class="form-group">
                    <label>Project type:</label>
                    <select class="form-control" name="project_type">
                        <option value="">-- Select --</option>
                        <option>Paint</option>
                        <option>Photo Series</option>
                        <option>Craft</option>
                        <option>Robotics</option>
                        <option>Website</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Brief</label>
                    <input class="form-control" type="text" name="project_brief">
                </div>
                <div class="form-group">
                    <label>Content:</label>
                    <textarea class="form-control" type="text" name="project_content"></textarea>
                </div>
                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="file" name="project_thumbnail" class="form-control">
                </div>
                <div clas="form-group">
                    <label>Header Image</label>
                    <input type="file" name="project_header" class="form-control">
                </div>
                <button class="btn btn-success">Post Project</button>
            </form>
        </div>
    </div>
</div>