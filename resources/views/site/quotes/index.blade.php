@extends('site.app')
@section('title')  @endsection
@section('content')



<section class="inner_banner questionBanner">
    <div class="container">
        <div class="questionBanner_text">
            <h1>
                We have tradies ready to help you with your job.
            </h1>
            <div class="searchCard">
                <form action="">
                    <label>What do you need help with?</label>
                    <div class="searchCard_form">
                        <input class="form-control" type="text" placeholder="e.g. Remove moudl from">
                        <button type="button" data-toggle="modal" data-target="#questionModal" class="searchCard_formBtn btn">Get Quotes</button>
                    </div>
                </form>
            </div>
            <div class="questionBanner_text_bottom">
                <h3>How can you best protect yourself while getting a job done?</h3>
                <p>We understand that these are uncertain times, and the safety of our consumers and tradies is of greatest importance. Before your job starts, ensure you and your tradie are both agreed on the recommended safety measures you will both take. And if you or anyone in your household is feeling unwell, consider posting the job at a later date.</p>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModal" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="questionModalLabel"></h5>
                <button type="button" class="close openAlertModal" data-toggle="modal" data-target="#questionAlertModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="questionSetItem">
                        <div class="questionSetItem_box">
                            <h4>What is your postcode?</h4>
                            <input type="text" placeholder="">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="questionSetItemButton">Next</button>
                        </div>
                    </div>

                    <div class="questionSetItem">
                        <div class="questionSetItem_box">
                            <h4>What is your Question?</h4>
                            <select class="form-control"    >
                                <option>Select 1</option>
                                <option>Select 2</option>
                                <option>Select 3</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="questionSetItemButtonPrev">Prev</button>
                            <button type="button" class="questionSetItemButton">Next</button>
                        </div>
                    </div>
                    <div class="questionSetItem">
                        <div class="questionSetItem_box">
                            <h4>What is your Question?</h4>
                            <textarea placeholder="Enter Text" class="form-control"></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="questionSetItemButtonPrev">Prev</button>
                            <button type="button" class="questionSetItemButton">Next</button>
                        </div>
                    </div>
                    <div class="questionSetItem">
                        <div class="questionSetItem_box">
                            <h4>What is your budget?</h4>
                            <div class="questionSetItem_box questionSetItem_box_options">
                                <div class="questionSetItem_box_options_radio">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Default radio
                                    </label>
                                </div>
                                <div class="questionSetItem_box_options_radio">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Default radio
                                    </label>
                                </div>
                                <div class="questionSetItem_box_options_radio">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Default radio
                                    </label>
                                </div>
                                <div class="questionSetItem_box_options_radio">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
                                    <label class="form-check-label" for="flexRadioDefault4">
                                        Default radio
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="questionSetItemButtonPrev">Prev</button>
                            <button type="submit" class="questionSetItemButtonSubmit">Submit</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
    <div class="modal fade" id="questionAlertModal" tabindex="-1" aria-labelledby="questionAlertModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="mb-4 text-center">
                        <h4>Are you sure you want to leave?</h4>
                        <p>Closing this form will erase all the answers you’ve provided.</p>
                    </div>
                    <div class="d-flex justify-content-between questionAlertModalButton">
                        <button type="button" class="btn leaveBtn" data-toggle="modal" data-target="#questionModal" data-dismiss="modal">Leave</button>
                        <button type="button" class="btn stayBtn" data-dismiss="modal">Stay and Post Your Job</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
