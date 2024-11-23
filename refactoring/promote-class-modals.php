<!-- for passing out a class -->
<div class="modal fade" id="passOut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header card-bg-header text-white">
                <h5 class="modal-title" id="staticBackdropLabel"><strong></strong></h5>
                <button type="button" class="ms-auto bg-transparent border-0 text-white" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <form action="" method="post">
                <div class="modal-body" id="">
                    <p class="lead" id="addFeeReg"><strong>This means that the students of this class have completed their studies at <strong><?php echo $_SESSION['school_name']; ?></strong> and from now will be the <strong>alumini of <?php echo $_SESSION['school_name']; ?></strong>!</strong></p>
                    <input type="hidden" name="section_id" id="passSectionId">
                    <input type="hidden" name="class_section" id="passClassSection">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="pass_out" class="btn btn-success">Pass Out</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- for promoting a class -->
<div class="modal fade" id="promote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header card-bg-header text-white">
                <h5 class="modal-title" id="pstaticBackdropLabel"><strong></strong></h5>
                <button type="button" class="ms-auto bg-transparent border-0 text-white" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <form action="" method="post">
                <div class="modal-body" id="">
                    <div class="py-2">
                        <label for="classes" class="form-label"><strong>Select Class(for promotion) <code>*</code></strong></label>
                        <div class="col-auto">
                            <div class="input-group">
                                <select id="emptySection"
                                    name="promotion_section"
                                    class="form-select"
                                    onchange="ifNotEmpty(this.value)"
                                    aria-describedby="button-addon1"
                                    required>
                                    <option value="" disabled selected>Choose Class</option>
                                    <?php
                                    // fetching all the classes
                                    $query = "SELECT * FROM all_classes WHERE fk_client_id='$client'";
                                    $result = query($query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $clas_id = $row['class_id'];
                                    ?>
                                        <optgroup label="Class: <?php echo $row['class_name']; ?>">
                                            <?php
                                            // fetching the related sections
                                            $query = "SELECT * FROM class_sections WHERE fk_class_id='$clas_id' AND fk_client_id='$client'";
                                            $result1 = query($query);
                                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                            ?>
                                                <option value="<?php echo $row1['section_id']; ?>"><?php echo $row['class_name'] . " " . $row1['section_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </optgroup>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="section_id" id="promoteSectionId">
                    <input type="hidden" name="class_section" id="promoteClassSection">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="promote" class="btn btn-success">Promote</button>
                </div>
            </form>
        </div>
    </div>
</div>