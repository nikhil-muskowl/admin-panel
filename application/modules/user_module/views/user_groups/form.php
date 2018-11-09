<div class="content-wrapper">  
    <div class="content">
        <div class="card">
            <div class="card-header">   
                <div class="button-group float-right">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <a href="<?= $ajax_list ?>" class="btn btn-danger">Cancel</a>

                </div>
                <div class="card-title">
                    <h2><?= $meta_title ?></h2>
                </div>  
            </div>
            <div class="card-body">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="<?= $id ?>" name="id"/>  

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#commonTab">Common</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#permissionTab">Permission</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content clearfix">
                        <div class="tab-pane container active" id="commonTab">
                            <ul class="nav nav-tabs">
                                <?php foreach ($details as $key => $value) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?php if ($key == 0): ?> active <?php endif; ?>" data-toggle="tab" href="#detailsTab<?= $value['id'] ?>"><?= $value['language'] ?></a>
                                    </li>                            
                                <?php endforeach; ?>
                            </ul>
                            <br>
                            <div class="tab-content clearfix">
                                <?php foreach ($details as $key => $value) : ?>
                                    <div class="tab-pane container <?php if ($key == 0): ?> active <?php endif; ?>" id="detailsTab<?= $value['id'] ?>">
                                        <div class="form-group row">
                                            <label class="control-label col-md-2"><?= humanize('title') ?></label>
                                            <div class="col-md-10">
                                                <input name="details[<?= $value['id'] ?>][title]" value="<?= $value['title'] ?>" placeholder="<?= humanize('title') ?>" class="form-control" type="text">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>   
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="tab-pane container fade" id="permissionTab">
                            <div id="accordion">
                                <?php foreach ($modules as $moduleKey => $module) : ?>
                                    <?php if (($module['children'])): ?>
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse" href="#collapse<?= $moduleKey ?>">
                                                    <?= $module['name'] ?>
                                                </a>
                                            </div>
                                            <div id="collapse<?= $moduleKey ?>" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <?php foreach ($module['children'] as $children) : ?>
                                                        <h5><?= $children['name'] ?></h5>
                                                        <?php if ($children['permissions']): ?>
                                                            <?php foreach ($children['permissions'] as $permissionskey => $permissionvalue) : ?>
                                                                <div class="form-check-inline">
                                                                    <label class="form-check-label">
                                                                        <?php if ($permissionvalue): ?>
                                                                            <input type="checkbox" class="form-check-input" name="module_permissions[<?= $children['code'] ?>][<?= $permissionskey ?>]" checked>
                                                                        <?php else: ?>
                                                                            <input type="checkbox" class="form-check-input" name="module_permissions[<?= $children['code'] ?>][<?= $permissionskey ?>]">
                                                                        <?php endif; ?>
                                                                        <?= humanize($permissionskey) ?>
                                                                    </label>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>                                                        
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div> 
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>