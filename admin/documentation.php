<?php
if (isset($_SESSION['nama'])) {
?>
    <div class="header header-documentation">
        <a>Documentation</a>
    </div>

    <div class="page-documentation">
        <div>
        <div class="row-file">
            <a href="index.php?p=perencanaan">
                <div class="box-file-documentation">
                    <i class='bx bxs-folder-open'></i>
                    <span>Dokumen Perencanaan</span>
                </div>
            </a>

            <a href="index.php?p=evaluasi">
                <div class="box-file-documentation">
                    <i class='bx bxs-folder-open'></i>
                    <span>Dokumen Evaluasi Operasi</span>
                </div>
            </a>

        </div>

        <div class="row-file">

            <a href="index.php?p=profil_kelistrikan">
                <div class="box-file-documentation">
                    <i class='bx bxs-folder-open'></i>
                    <span>Dokumen Profil Kelistrikan</span>
                </div>
            </a>

            <a href="index.php?p=sop_pengoperasian">
                <div class="box-file-documentation">
                    <i class='bx bxs-folder-open'></i>
                    <span>Dokumen SOP Pengoperasian</span>
                </div>
            </a>

        </div>

        </div>

        <div class="row-file file-item">

            <a href="index.php?p=singel_line_diagram">
                <div class="box-file-documentation">
                    <i class='bx bxs-folder-open'></i>
                    <span>Dokumen Single Line Diagram</span>
                </div>
            </a>

        </div>

    </div>

<?php
} else {
    echo '<script>alert("Mohon maaf untuk membuka halaman ini Anda harus login dahulu")</script>';
    echo '<script>window.location.href = "Login.php";</script>';
}
?>
<!-- <div class="file_manager">
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/87CEFA/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>                            
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/FF69B4/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/FFA07A/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/B0C4DE/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/9370DB/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>               
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/48D1CC/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/DA70D6/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/DB7093/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>                            
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/DDA0DD/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/FFC0CB/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/FA8072/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/4682B4/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>               
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/40E0D0/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/87CEFA/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/FA8072/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-doc">
                        <div class="file">
                            <a href="javascript:void(0);">
                                <div class="hover">
                                    <button type="button" class="btn btn-icon btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="image">
                                    <img src="https://www.bootdey.com/image/280x280/87CEFA/000000" alt="img" class="img-fluid">
                                </div>
                                <div class="file-name">
                                    <p class="m-b-5 text-muted">img21545ds.jpg</p>
                                    <small>Size: 2MB <span class="date text-muted">Dec 11, 2017</span></small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div> -->