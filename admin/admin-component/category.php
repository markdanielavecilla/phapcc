<div class="container">
    <!-- SUBSPECIALTY -->
    <div class="row my-3">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-text">
                    <label for="subspecialty">Subspecialty</label>
                </div>
                <select 
                    name="subspecialty[]" 
                    id="subspecialty"
                    multiple
                    class="form-control my-select"
                    data-selected-text-format="count > 2"
                >
                    <?php
                        $sql = "SELECT * FROM tbl_hospital_subspecialty WHERE information_id = ?";
                        if($sb = $conn->prepare($sql)) {
                           $sb->bind_param("i", $user_id);
                           $sb->execute();
                           $resultSb = $sb->get_result();
                           $subspecialty = array();
                           while($rowSb = $resultSb->fetch_assoc()) {
                            $subspecialty[] = $rowSb['subspecialty_id'];
                           }
                           $sb->close();
                        } else {
                            $errorSb = $conn->errno.' '.$conn->error;
                            echo $errSb;
                            return;
                        }

                        $sql = "SELECT * from tbl_subspecialty where status = ?";
                        if($getSb = $conn->prepare($sql)) {
                            $getSb->bind_param("i", $active_status);
                            $getSb->execute();
                            $resultGetSb = $getSb->get_result();
                            $getSb->close();
                        } else {
                            $errorSb = $conn->errno.' '.$conn->error;
                            echo $errSb;
                            return;
                        }
                        while($rowGetSb = $resultGetSb->fetch_assoc()) :
                    ?>
                    <option 
                        value="<?= $rowGetSb['sub_id'] ?>"
                        <?= in_array($rowGetSb['sub_id'], $subspecialty) ? 'selected' : '' ?>
                    >
                        <?= ucwords($rowGetSb['subspecialty']) ?>
                    </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <?php
                $osSql = "SELECT u_id, other_subspecialty from tbl_other_subspecialty where u_id = ?";
                if($os = $conn->prepare($osSql)) {
                    $os->bind_param("i", $user_id);
                    $os->execute();
                    $resultOs = $os->get_result();
                    $osRow = $resultOs->fetch_assoc();
                    $os->close();
                } else {
                    $errorOs = $conn->errno.' '.$conn->error;
                    echo $errOs;
                }
            ?>
            <input 
                type="text"
                class="form-control"
                name="other_subspecialty"
                placeholder="Other subspecialty"
            />
            <span class="small">
                <strong>Note: </strong>
                If more than one subspecialty, put comma (,) to separate it. (e.g. Cardiac Rehab, Echocardiography, etc...)
            </span>
        </div>
    </div>

    <!-- SPECIAL TRAINING -->
    <div class="row my-3">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-text">
                    <label for="special_training">Special Training</label>
                </div>
                <select 
                    name="special_training[]" 
                    id="special_training"
                    multiple
                    class="form-control my-select"
                    data-selected-text-format="count > 2"
                >
                    <?php
                        $sql = "SELECT * FROM tbl_hospital_special_training WHERE information_id = ?";
                        if($st = $conn->prepare($sql)) {
                            $st->bind_param("i", $user_id);
                            $st->execute();
                            $resultSt = $st->get_result();
                            $specialTraining = array();
                            while($rowSt = $resultSt->fetch_assoc()) {
                                $specialTraining[] = $rowSt['special_training_id'];
                            }
                            $st->close();
                        } else {
                            $errorSt = $conn->errno.' '.$conn->error;
                            echo $errorSt;
                        }

                        $sql = "SELECT * FROM tbl_special_training WHERE status = ?";
                        if($getSt = $conn->prepare($sql)) {
                            $getSt->bind_param("i", $active_status);
                            $getSt->execute();
                            $resultGetSt = $getSt->get_result();
                            $getSt->close();
                        } else {
                            $errGetSt = $conn->errno.' '.$conn->error;
                            echo $errGetSt;
                        }
                        while($rowGetSt = $resultGetSt->fetch_assoc()) :
                    ?>
                        <option 
                            value="<?= $rowGetSt['st_id'] ?>"
                            <?= in_array($rowGetSt['st_id'], $specialTraining) ? 'selected' : '' ?>
                        >
                            <?= $rowGetSt['special_training'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <?php
                $sql = "SELECT u_id, other_special_training FROM tbl_other_special_training WHERE u_id = ?";
                if($getOst = $conn->prepare($sql)) {
                    $getOst->bind_param("i", $user_id);
                    $getOst->execute();
                    $resultOst = $getOst->get_result();
                    $rowOst = $resultOst->fetch_assoc();
                }
            ?>
            <input 
                type="text"
                class="form-control"
                name="other_specialTraining"
                placeholder="Other special training"
            />
            <span class="small">
                <strong>Note: </strong>If more than one special training, put comma (,) to separate it. (e.g. MD, FPCP, etc...)
            </span>
        </div>
    </div>

    <!-- PRACTICE -->
    <div class="row my-3">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-text">
                    <label for="practice">Practice</label>
                </div>
                <select 
                    name="practice[]" 
                    id="practice"
                    multiple
                    class="form-control my-select"
                    data-selected-text-format="count > 2"
                >
                    <?php
                        $sql = "SELECT * FROM tbl_hospital_practice WHERE information_id = ?";
                        if($p = $conn->prepare($sql)) {
                            $p->bind_param("i", $user_id);
                            $p->execute();
                            $resultP = $p->get_result();
                            $practice = array();
                            while($rowP = $resultP->fetch_assoc()) {
                                $practice[] = $rowP['practice_id'];
                            }
                            $p->close();
                        } else {
                            $errP = $conn->errno.' '.$conn->error;
                            echo $errP;
                        }

                        $sql = "SELECT * FROM tbl_practice WHERE status = ?";
                        if($getP = $conn->prepare($sql)) {
                            $getP->bind_param("i", $active_status);
                            $getP->execute();
                            $resultGetP = $getP->get_result();
                            $getP->close();
                        } else {
                            $errGetP = $conn->errno.' '.$conn->error;
                            echo $errGetP;
                        }
                        while($rowGetP = $resultGetP->fetch_assoc()) :
                    ?>
                        <option 
                            value="<?= $rowGetP['practice_id'] ?>"
                            <?= in_array($rowGetP['practice_id'], $practice) ? 'selected' : '' ?>
                        >
                            <?= ucwords($rowGetP['practice']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <?php
                $sql = "SELECT u_id, other_practice FROM tbl_other_practice WHERE u_id = ?";
                if($otherPractice = $conn->prepare($sql)) {
                    $otherPractice->bind_param("i", $user_id);
                    $otherPractice->execute();
                    $resultOp = $otherPractice->get_result();
                    $rowOp = $resultOp->fetch_assoc();
                    $otherPractice->close();
                } else {
                    $otherpractice_error = $conn->errno.' '.$conn->error;
                    $_SESSION['message'] = "<div class='alert alert-danger'>$otherpractice_error</div>";
                }
            ?>
            <input 
                type="text"
                class="form-control"
                name="other_practice"
                placeholder="Other practice"
            />
            <span class="small">
                <strong>Note: </strong>
                If more than one practice, put comma (,) to separate it. (e.g. Adult, Pedia, etc...)
            </span>
        </div>
    </div>

    <!-- CATEGORY -->
    <div class="row my-3">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-text">
                    <label for="category">Category</label>
                </div>
                <select 
                    name="category[]" 
                    id="category"
                    multiple
                    class="form-control my-select"
                    data-selected-text-format="count > 2"
                >
                    <?php
                        $sql = "SELECT * FROM tbl_hospital_drcategory WHERE information_id = ?";
                        if($cat = $conn->prepare($sql)) {
                            $cat->bind_param("i", $user_id);
                            $cat->execute();
                            $resultCat = $cat->get_result();
                            $cat->close();
                            $category = array();
                            while($rowCat = $resultCat->fetch_assoc()) {
                                $category[] = $rowCat['category_id'];
                            }
                        } else {
                            $errCat = $conn->errno.' '.$conn->error;
                            $_SESSION['message'] = "<div class='alert alert-danger'>$errCat</div>";
                        }
    
                        $sql = "SELECT * FROM tbl_drcategory WHERE status = ?";
                        if($getCategory = $conn->prepare($sql)) {
                            $getCategory->bind_param("i", $active_status);
                            $getCategory->execute();
                            $resultCategory = $resultGetCat = $getCategory->get_result();
                            $getCategory->close();
                        } else {
                            $errGetCat = $conn->errno.' '.$conn->error;
                            $_SESSION['message'] = "<div class='alert alert-danger'>$errGetCat</div>";
                        }
                        while($rowGetCat = $resultGetCat->fetch_assoc()) :
                    ?>
                    <option 
                        value="<?= $rowGetCat['catid'] ?>"
                        <?= in_array($rowGetCat['catid'], $category) ? 'selected': '' ?>
                    >
                        <?= ucwords($rowGetCat['category']) ?>
                    </option>
                    <?php endwhile ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <?php
                $sql = "SELECT u_id, category FROM tbl_other_drcategory WHERE u_id = ?";
                if($otherCat = $conn->prepare($sql)) {
                    $otherCat->bind_param("i", $user_id);
                    $otherCat->execute();
                    $resultOc = $otherCat->get_result();
                    $rowOc = $resultOc->fetch_assoc();
                }
            ?>
            <input 
                type="text"
                class="form-control"
                name="other_category"
                placeholder="Other category"
            />
            <span class="small">
                <strong>Note:</strong>
                If more than one category, put comma (,) to separate it. (e.g. Fellow, Life fellow, etc...)
            </span>
        </div>
    </div>

    <!-- COUNCIL -->
    <div class="row my-3">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-text">
                    <label for="council">Council</label>
                </div>
                <select 
                    name="council[]" 
                    id="council"
                    multiple
                    class="form-control my-select"
                    data-selected-text-format="count > 2"
                >
                    <?php
                        $sql = "SELECT * FROM tbl_hospital_council WHERE information_id = ?";
                        if($cl = $conn->prepare($sql)) {
                            $cl->bind_param("i", $user_id);
                            $cl->execute();
                            $resultCl = $cl->get_result();
                            $cl->close();
                            $council = array();
                            while($rowCl = $resultCl->fetch_assoc()) {
                                $council[] = $rowCl['council_id'];
                            }
                        } else {
                            $errCl = $conn->errno.' '.$conn->error;
                            $_SESSION['message'] = "<div class='alert alert-danger'>$errCl</div>";
                        }

                        $sql = "SELECT * FROM tbl_council WHERE status = ?";
                        if($getCl = $conn->prepare($sql)) {
                            $getCl->bind_param("i", $active_status);
                            $getCl->execute();
                            $resultGetCl = $getCl->get_result();
                            $getCl->close();
                        } else {
                            $errGetCl = $conn->errno.' '.$conn->error;
                            $_SESSION['message'] = "<div class='alert alert-danger'>$errGetCl</div>";
                        }
                        while($rowGetCl = $resultGetCl->fetch_assoc()) :
                    ?>
                        <option 
                            value="<?= $rowGetCl['council_id'] ?>"
                            <?= in_array($rowGetCl['council_id'], $council) ? 'selected' : '' ?>
                        >
                            <?= ucwords($rowGetCl['council']) ?>
                        </option>
                    <?php endwhile;?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <?php
                $sql = "SELECT u_id, other_council FROM tbl_other_council WHERE u_id = ?";
                if($otherCl = $conn->prepare($sql)) {
                    $otherCl->bind_param("i", $user_id);
                    $otherCl->execute();
                    $resultOtherCl = $otherCl->get_result();
                    $rowGetcl = $resultOtherCl->fetch_assoc();
                } else {
                    $errOtherCl = $conn->errno.' '.$conn->error;
                    $_SESSION['message'] = "<div class='alert alert-danger'>$errOtherCl</div>";
                }
            ?>
            <input 
                type="text"
                class="form-control"
                name="other_council"
                placeholder="Other council"
            />
            <span class="small">
                <strong>Note:</strong>
                If more than one council, put comma (,) to separate it.
            </span>
        </div>
    </div>

    <!-- COMMITTEE -->
    <div class="row my-3">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-text">
                    <label for="committee">Committee</label>
                </div>
                <select 
                    name="committee[]" 
                    id="committee"
                    multiple
                    class="form-control my-select"
                    data-selected-text-format="count > 2"
                >
                    <?php
                        $sql = "SELECT * FROM tbl_hospital_committee WHERE information_id = ?";
                        if($comm = $conn->prepare($sql)) {
                            $comm->bind_param("i", $user_id);
                            $comm->execute();
                            $resultComm = $comm->get_result();
                            $comm->close();
                            $committee = array();
                            while($rowComm = $resultComm->fetch_assoc()) {
                                $committee[] = $rowComm['cmt_id'];
                            }
                        } else {
                            $errComm = $conn->errno.' '.$conn->error;
                            $_SESSION['message'] = "<div class='alert alert-danger'>$errComm</div>";
                        }

                        $sql = "SELECT * FROM tbl_committee WHERE status = ?";
                        if($getComm = $conn->prepare($sql)) {
                            $getComm->bind_param("i", $active_status);
                            $getComm->execute();
                            $resultGetComm = $getComm->get_result();
                            $getComm->close();
                        } else {
                            $errGetComm = $conn->errno.' '.$conn->error;
                            $_SESSION['message'] = "<div class='alert alert-danger'>$errGetComm</div>";
                        }
                        while($rowGetComm = $resultGetComm->fetch_assoc()) :
                    ?>
                    <option 
                        value="<?= $rowGetComm['cmt_id'] ?>"
                        <?= in_array($rowGetComm['cmt_id'], $committee) ? 'selected' : '' ?>
                    >
                        <?= ucwords($rowGetComm['committee']) ?>
                    </option>
                    <?php endwhile;?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <?php
                $sql = "SELECT u_id, other_committee FROM tbl_other_committee WHERE u_id = ?";
                if($otherComm = $conn->prepare($sql)) {
                    $otherComm->bind_param("i", $user_id);
                    $otherComm->execute();
                    $resultOtherComm = $otherComm->get_result();
                    $rowOtherComm = $resultOtherComm->fetch_assoc();
                    $otherComm->close();
                } else {
                    $errOtherComm = $conn->errno.' '.$conn->error;
                    $_SESSION['message'] = "<div class='alert alert-danger'>$errOtherComm</div>";
                }
            ?>
            <input 
                type="text"
                class="form-control"
                name="other_committee"
                placeholder="Other committee"
            />
            <span class="small">
                <strong>Note:</strong>
                If more than one committee, put comma (,) to separate it
            </span>
        </div>
    </div>

    <!-- CHAPTER -->
    <div class="row my-3">
        <div class="col-md-6">
            <div class="input-group">
                <div class="input-group-text">
                    <label for="chapter">Chapter</label>
                </div>
                <select 
                    name="chapter[]" 
                    id="chapter"
                    multiple
                    class="form-control my-select"
                    data-selected-text-format="count > 2"
                >
                    <?php
                        $sql = "SELECT * FROM tbl_hospital_chapter WHERE information_id = ?";
                        if($chptr = $conn->prepare($sql)) {
                            $chptr->bind_param("i", $user_id);
                            $chptr->execute();
                            $resultChptr = $chptr->get_result();
                            $chptr->close();
                            $arrayChptr = array();
                            while($rowChptr = $resultChptr->fetch_assoc()) {
                                $arrayChptr[] = $rowChptr['chapter_id'];
                            }
                        } else {
                            $errorChptr = $conn->errno.' '.$conn->error;
                            $_SESSION['message'] = "<div class='alert alert-danger'>$errorChptr</div>";
                        }

                        $sql = "SELECT * FROM tbl_chapter WHERE status = ?";
                        if($getChapter = $conn->prepare($sql)) {
                            $getChapter->bind_param("i", $active_status);
                            $getChapter->execute();
                            $resultGetChapter = $getChapter->get_result();
                            $getChapter->close();
                        } else {
                            $errorGetChapter = $conn->errno.' '.$conn->error;
                            $_SESSION['message'] = "<div class='alert alert-danger'>$errorGetChapter</div>";
                        }
                        while($rowGetChapter = $resultGetChapter->fetch_assoc()) :
                    ?>
                    <option 
                        value="<?= $rowGetChapter['chapid'] ?>"
                        <?= in_array($rowGetChapter['chapid'], $arrayChptr) ? 'selected':'' ?>
                    >
                        <?= ucwords($rowGetChapter['chapter']) ?>
                    </option>
                    <?php
                        endwhile;
                    ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <?php
                $sql = "SELECT u_id, other_chapter FROM tbl_other_chapter WHERE u_id = ?";
                if($otherChap = $conn->prepare($sql)) {
                    $otherChap->bind_param("i", $user_id);
                    $otherChap->execute();
                    $resultOtherChap = $otherChap->get_result();
                    $getOtherChap = $resultOtherChap->fetch_assoc();
                    $otherChap->close();
                } else {
                    $otherChapError = $conn->errno.' '.$conn->error;
                    $_SESSION['message'] = "<div class='alert alert-danger'>$otherChapError</div>";
                }
            ?>
            <input 
                type="text"
                class="form-control"
                name="other_chapter"
                placeholder="Other Chapter"
                value="<?= isset($_POST['other_chapter']) ? $_POST['other_chapter'] : $getOtherChap['other_chapter'] ?>"
            />
            <span class="small"><strong>Note:</strong> If more than one chapter, put comma (,) to separate it. (e.g. Abroad, Bicol, etc...)</span>
        </div>
    </div>

    <button
        type="submit"
        class="btn btn-primary float-end mb-3"
        name="save"
    >
        Save
    </button>
</div>