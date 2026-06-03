@extends("layouts.app")
@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="procure-wrapper">
        <form action="" method="post">
            <div class="procure-box">
                <h5 class="procure-title">RM/PM Procurement</h5>
                <!-- Date Row -->
                <div class="row mb-3 center-row">
                    <div class="col-md-6">
                        <label class="procure-label">Shift from</label>
                        <input type="datetime-local" name="shift_from" class="procure-input" />
                    </div>
                    <div class="col-md-6">
                        <label class="procure-label">Shift to</label>
                        <input type="datetime-local" name="shift_to" class="procure-input" />
                    </div>
                </div>
                <!-- Toggle -->
                <div class="text-center mb-3">
                    <label class="procure-toggle active" onclick="switchCard('contractorCard', this)">
                        Company Owned Contractor Operated Line
                    </label>
                    <label class="procure-toggle" onclick="switchCard('companyCard', this)">
                        Company Owned Company Operated Line
                    </label>
                </div>
                <div class="maincard-procure" id="contractorCard">
                    <!-- Blowing -->
                    <div class="procure-card">
                        <h6 class="blowinghead text-center mb-3">Blowing</h6>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="procure-label">Category</label>
                                <input type="text" name="blowing_category" class="procure-input" value="Preform" />
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Type</label>
                                <select name="blowing_type" id="blowingType" class="procure-input"></select>
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Total Procured</label>
                                <input type="number" name="blowing_total" class="procure-input" />
                                <div class="procure-note">Max allowed 285kg</div>
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Unit</label>
                                <input type="text" name="blowing_unit" class="procure-input" value="KG" readonly />
                            </div>
                        </div>
                    </div>

                    <!-- Filler -->
                    <div class="procure-card">
                        <h6 class="fillerhead text-center mb-3">Filler</h6>
                        <!-- Row 1 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="procure-label">Category</label>
                                <input type="text" name="cap_category" class="procure-input" value="Cap" />
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Type</label>
                                <input type="text" name="cap_type" class="procure-input" value="Blue" />
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Total Procured</label>
                                <input type="number" name="cap_total" class="procure-input" />
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Unit</label>
                                <input type="text" name="cap_unit" class="procure-input" value="PC" readonly />
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="text" name="label_category" class="procure-input" value="Label" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="label_type" class="procure-input" value="BOPP 1Ltr." />
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="label_total" class="procure-input" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="label_unit" class="procure-input" value="KG" readonly />
                            </div>
                        </div>

                        <!-- Row 3 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="text" name="sticker_category" class="procure-input" value="Sticker" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="sticker_type" class="procure-input" value="200ml" />
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="sticker_total" class="procure-input" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="sticker_unit" class="procure-input" value="PC" readonly />
                            </div>
                        </div>

                        <!-- Row 4 -->
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="ld_category" class="procure-input" value="LD" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="ld_type" class="procure-input" value="520mm x 90m" />
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="ld_total" class="procure-input" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="ld_unit" class="procure-input" value="KG" readonly />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="maincard-procure" id="companyCard">
                    <!-- Blowing -->
                    <div class="procure-card">
                        <h6 class="blowinghead text-center mb-3">Blowingsssss</h6>
                        <div class="row">
                            <div class="col-md-3">
                                <label class="procure-label">Category</label>
                                <input type="text" name="blowing_category" class="procure-input" value="Preform" />
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Type</label>
                                <select name="blowing_type" id="blowingType" class="procure-input"></select>
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Total Procured</label>
                                <input type="number" name="blowing_total" class="procure-input" />
                                <div class="procure-note">Max allowed 285kg</div>
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Unit</label>
                                <input type="text" name="blowing_unit" class="procure-input" value="KG" readonly />
                            </div>
                        </div>
                    </div>

                    <!-- Filler -->
                    <div class="procure-card">
                        <h6 class="fillerhead text-center mb-3">Filler</h6>
                        <!-- Row 1 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="procure-label">Category</label>
                                <input type="text" name="cap_category" class="procure-input" value="Cap" />
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Type</label>
                                <input type="text" name="cap_type" class="procure-input" value="Blue" />
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Total Procured</label>
                                <input type="number" name="cap_total" class="procure-input" />
                            </div>
                            <div class="col-md-3">
                                <label class="procure-label">Unit</label>
                                <input type="text" name="cap_unit" class="procure-input" value="PC" readonly />
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="text" name="label_category" class="procure-input" value="Label" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="label_type" class="procure-input" value="BOPP 1Ltr." />
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="label_total" class="procure-input" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="label_unit" class="procure-input" value="KG" readonly />
                            </div>
                        </div>

                        <!-- Row 3 -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="text" name="sticker_category" class="procure-input" value="Sticker" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="sticker_type" class="procure-input" value="200ml" />
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="sticker_total" class="procure-input" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="sticker_unit" class="procure-input" value="PC" readonly />
                            </div>
                        </div>

                        <!-- Row 4 -->
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="ld_category" class="procure-input" value="LD" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="ld_type" class="procure-input" value="520mm x 90m" />
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="ld_total" class="procure-input" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="ld_unit" class="procure-input" value="KG" readonly />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit -->
                <button type="submit" class="procure-btn" type="submit">Calculate</button>
            </div>
        </form>
    </div>
</div>


<script>
    function switchCard(id, el) {
                    
        document.querySelectorAll(".maincard-procure").forEach((div) => (div.style.display = "none"));
        document.getElementById(id).style.display = "block";

        document.querySelectorAll(".procure-toggle").forEach((btn) => btn.classList.remove("active"));
        el.classList.add("active");
    }
</script>

@endsection