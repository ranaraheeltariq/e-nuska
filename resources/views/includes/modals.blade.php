 {{-- Customer Remarks Modal Start --}}
              <div class="modal fade" id="remarks" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Customer Remarks: </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="nremarksform" action="" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="lead_id" id="lead_id" value="">
                              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                              <div class="form-group">
                                <label for="expire" class="col-form-label">Remarks:</label>
                                <textarea class="form-control" name="description"></textarea> 
                              </div>
                               <button type="submit" name="submit" class="btn btn-success">Submit</button>
                               </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- Customer Remarks Modal End --}}
 {{-- Customer Not Interested Modal Start --}}
              <div class="modal fade" id="notinterested" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Customer Not Interested: </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="notinterestedform" action="" method="post">
                              {{ csrf_field() }}
                              {{ method_field('PUT') }}
                              <input type="hidden" name="status_id" value="3">
                              <div class="form-group">
                                <label for="expire" class="col-form-label">Remarks:</label>
                                <textarea class="form-control" name="remarks"></textarea> 
                              </div>
                               <button type="submit" name="submit" class="btn btn-success">Submit</button>
                               </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- Customer Not Interested Modal End --}}

                     {{-- Lead Detail Modal Start --}}
              <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Lead detail: </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                                          <div class="border-bottom py-4">
                                        <p class="clearfix cname">
                                          <span class="float-left"> Customer Name </span>
                                          <span class="float-right text-muted" id="cname"></span>
                                        </p>
                                        <p class="clearfix number">
                                          <span class="float-left"> Phone </span>
                                          <span class="float-right text-muted" id="number"></span>
                                        </p>
                                        <p class="clearfix dname">
                                          <span class="float-left"> Doctor Name </span>
                                          <span class="float-right text-muted" id="dname"></span>
                                        </p>
                                        <p class="clearfix dnumber">
                                          <span class="float-left"> Doctor Number </span>
                                          <span class="float-right text-muted" id="dnumber"></span>
                                        </p>
                                        <p class="clearfix dclinic">
                                          <span class="float-left"> Doctor Clinic </span>
                                          <span class="float-right text-muted" id="dclinic"></span>
                                        </p>
                                        <p class="clearfix file1">
                                          <span class="float-left"> Prescription </span>
                                          <span class="float-left"></span>
                                        </p>
                                        <p class="clearfix file">
                                          <span class="float-left ml-5 text-muted" id="file1"></span>
                                          <span class="float-right mr-5 text-muted" id="file2"></span>
                                        </p>
                                        <div class="remarks">

                                        </div>
                                      </div>
                                    <div class="py-4 Alternate">
                                      <h3>Product Details</h3>
                                      <p class="clearfix product">
                                          <span class="float-left font-weight-bold"> Medicine Name </span>
                                          <span class="float-right font-weight-bold"> Quantity </span>
                                        </p>
                                      <div class="products">

                                      </div>
                                </div>
                          </div>
                          <div class="modal-footer">
                            {{-- <button type="submit" name="submit" class="btn btn-success">Submit</button> --}}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- Lead Detail Modal End --}}

                    {{-- Order Detail Modal Start --}}
              <div class="modal fade" id="orderdetailModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Order detail: </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                                          <div class="border-bottom py-4">
                                        <p class="clearfix cname">
                                          <span class="float-left"> Customer Name </span>
                                          <span class="float-right text-muted" id="cname"></span>
                                        </p>
                                        <p class="clearfix number">
                                          <span class="float-left"> Phone </span>
                                          <span class="float-right text-muted" id="number"></span>
                                        </p>
                                        <p class="clearfix address">
                                          <span class="float-left"> Address </span>
                                          <span class="float-right text-muted" id="address"></span>
                                        </p>
                                        <p class="clearfix dname">
                                          <span class="float-left"> Doctor Name </span>
                                          <span class="float-right text-muted" id="dname"></span>
                                        </p>
                                        <p class="clearfix dnumber">
                                          <span class="float-left"> Doctor Number </span>
                                          <span class="float-right text-muted" id="dnumber"></span>
                                        </p>
                                        <p class="clearfix dclinic">
                                          <span class="float-left"> Doctor Clinic </span>
                                          <span class="float-right text-muted" id="dclinic"></span>
                                        </p>
                                        <p class="clearfix invwod">
                                          <span class="float-left"> Invoice Without Discount </span>
                                          <span class="float-right text-muted" id="invwod"></span>
                                        </p>
                                        <p class="clearfix invwd">
                                          <span class="float-left"> Invoice With Discount </span>
                                          <span class="float-right text-muted" id="invwd"></span>
                                        </p>
                                        <p class="clearfix file1">
                                          <span class="float-left"> Invoice </span>
                                          <span class="float-left"></span>
                                        </p>
                                        <p class="clearfix file">
                                          <span class="float-left ml-5 text-muted" id="file1"></span>
                                          <span class="float-right mr-5 text-muted" id="file2"></span>
                                        </p>
                                        <div class="remarks">

                                        </div>
                                      </div>
                                    <div class="py-4 Alternate">
                                      <h3>Product Details</h3>
                                      <p class="clearfix product">
                                          <span class="float-left font-weight-bold"> Medicine Name </span>
                                          <span class="float-right font-weight-bold"> Quantity </span>
                                        </p>
                                      <div class="products">

                                      </div>
                                </div>
                          </div>
                          <div class="modal-footer">
                            {{-- <button type="submit" name="submit" class="btn btn-success">Submit</button> --}}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- Order Detail Modal End --}}

                    {{-- Assign Rider Modal Start --}}
              <div class="modal fade" id="rider" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Assign Rider: </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="assignrider" action="" method="post">
                              {{ csrf_field() }}
                              {{ method_field('PUT') }}
                              <input type="hidden" name="status_id" value="4">
                              <div class="form-group">
                                <label for="expire" class="col-form-label">Select Rider:</label>
                                <select class="js-example-basic-single" name="user_id" id="user_id" style="width:100%">
                                <option value="">Select Rider</option>
                                @foreach(App\Models\User::where('department_id',4)->get() as $rider)
                                  <option value="{{ $rider->id }}">{{ $rider->name }} {{ $rider->mobile == null ? "" : "(".$rider->mobile.")" }}</option>
                                @endforeach
                                </select>
                              </div>
                               <button type="submit" name="submit" class="btn btn-success">Submit</button>
                               </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- Assign Rider Modal End --}}
                    {{-- Invoice Upload Modal Start --}}
              <div class="modal fade" id="uploadinvoice" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Assign Rider: </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="invoiceform" action="" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              {{ method_field('PUT') }}
                              <input type="hidden" name="status_id" value="8">
                              <div class="form-group">
                                <label for="expire" class="col-form-label">Upload Invoice:</label>
                                <input type="file" name="invoice_file" id="invoice_file" class="file-upload-default">
                                <div class="input-group col-sm-9">
                                  <input type="text" class="form-control{{ $errors->has('invoice_file') ? ' form-control-danger' : '' }} file-upload-info" disabled placeholder="Prescription Upload">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                  </span>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="amount" class="col-form-label">Invoice Without Discount:</label>
                                <input type="text" name="invoice_without_discount" class="form-control" id="amount">
                              </div>
                              <div class="form-group">
                                <label for="damount" class="col-form-label">Invoice With Discount:</label>
                                <input type="text" name="invoice_with_discount" class="form-control" id="damount">
                              </div>
                               <button type="submit" name="submit" class="btn btn-success">Submit</button>
                               </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- Invoice Upload Modal End --}}