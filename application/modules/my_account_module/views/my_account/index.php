<div class="content-wrapper">  
    <div class="content">
        <div class="card">
            <div class="card-header">                    
                <div class="card-title">
                    <h2><?= $meta_title ?></h2>
                </div>        
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?= $image_thumb ?>" alt="<?= $name ?>" height="200">
                            <div class="card-body">
                                <h5 class="card-title"><?= $name ?></h5>
                                <p class="card-text"><?= $email ?></p>                        
                                <p class="card-text"><?= $contact ?></p>                        
                                <p class="card-text"><?= $dob ?></p>                        
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="<?= base_url('my_account_module/update_password') ?>">change password</a></li>
                            <li class="list-group-item"><a href="<?= base_url('my_account_module/update_password') ?>">update profile</a></li>                            
                            <li class="list-group-item"><a href="<?= base_url('dashboard/logout') ?>">logout</a></li>                            
                        </ul>
                    </div>                    
                </div>
            </div>    
        </div>
    </div>
</div>


