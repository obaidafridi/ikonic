
@props(['suggested_users','send_requests','recieved_requests','connected'])
<div class="row justify-content-center mt-5">
  <div class="col-12">
    <div class="card shadow  text-white bg-dark">
      <div class="card-header">Coding Challenge - Network connections</div>
      <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item w-25" role="presentation">
                <button class="nav-link active w-100" id="pills-suggestion-tab" data-bs-toggle="pill" data-bs-target="#pills-suggestion" type="button" role="tab" aria-controls="pills-suggestion" aria-selected="true">Suggestion({{count($suggested_users)}})</button>
              </li>
              <li class="nav-item w-25" role="presentation">
                <button class="nav-link w-100" id="pills-request-tab" data-bs-toggle="pill" data-bs-target="#pills-request" type="button" role="tab" aria-controls="pills-request" aria-selected="false">Sent Requests ({{count($send_requests)}})</button>
              </li>
              <li class="nav-item w-25 role="presentation">
                <button class="nav-link w-100" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                    ReceivedRequests({{count($recieved_requests)}})
                </button>
              </li>
              <li class="nav-item w-25" role="presentation">
                <button class="nav-link w-100" id="pills-connect-tab" data-bs-toggle="pill" data-bs-target="#pills-connect" type="button" role="tab" aria-controls="pills-connect" aria-selected="false">
                    Connects({{count($connected)}})
                </button>
              </li>
            </ul>
        <hr>
        <div id="content" >
    
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-suggestion" role="tabpanel" aria-labelledby="pills-suggestion-tab">
                    @foreach($suggested_users as $sg_user)
                    <div class="my-2 shadow  text-white bg-dark p-1" id="">
                      <div class="d-flex justify-content-between">
                        <table class="ms-1">
                          <td class="align-middle">{{$sg_user->name}}</td>
                          <td class="align-middle"> - </td>
                          <td class="align-middle">{{$sg_user->email}}</td>
                          <td class="align-middle"> 
                        </table>
                        <div>
                          <button id="create_request_btn_" class="btn btn-primary me-1" onclick="sendRequest('{{Auth::user()->id}}','{{$sg_user->id}}',this);">Connect</button>
                        </div>

                      </div>
                    </div>
                    @endforeach
               
              </div>
              <div class="tab-pane fade" id="pills-request" role="tabpanel" aria-labelledby="pills-request-tab">
                    @foreach($send_requests as $sq_user)
                      <div class="my-2 shadow text-white bg-dark p-1" id="">
                          <div class="d-flex justify-content-between">
                            <table class="ms-1">
                              <td class="align-middle">{{$sq_user->send_rquests->name}}</td>
                              <td class="align-middle"> - </td>
                              <td class="align-middle">{{$sq_user->send_rquests->email}}</td>
                              <td class="align-middle">
                            </table>
                            <div>
                                <button id="cancel_request_btn_" class="btn btn-danger me-1"
                                  onclick="deleteRequest('{{Auth::user()->id}}','{{$sq_user->friend_id}}',this);">Withdraw Request</button>
                            </div>
                          </div>
                    </div>
                    @endforeach
              </div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                  @foreach($recieved_requests as $rq_user)
                    <div class="my-2 shadow text-white bg-dark p-1" id="">
                          <div class="d-flex justify-content-between">
                            <table class="ms-1">
                              <td class="align-middle">{{$rq_user->receive_rquests->name}}</td>
                              <td class="align-middle"> - </td>
                              <td class="align-middle">{{$rq_user->receive_rquests->email}}</td>
                              <td class="align-middle">
                            </table>
                            <div>
                                <button id="accept_request_btn_" class="btn btn-primary me-1"
                                 onclick="acceptRequest('{{Auth::user()->id}}','{{$rq_user->user_id}}',this);">Accept</button>
                            </div>
                          </div>
                    </div>
                  @endforeach
              </div>
              <!-- connection tab -->
              <div class="tab-pane fade" id="pills-connect" role="tabpanel" aria-labelledby="pills-connect-tab">
                  @foreach($connected as $conn)
                    <div class="my-2 shadow text-white bg-dark p-1" id="">
                      <div class="d-flex justify-content-between">
                        <table class="ms-1">
                          <td class="align-middle">{{$conn->name}}</td>
                          <td class="align-middle"> - </td>
                          <td class="align-middle">{{$conn->email}}</td>
                          <td class="align-middle">
                        </table>
                        <div>
                          <button style="width: 220px" id="get_connections_in_common_" class="btn btn-primary" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse_" aria-expanded="false" aria-controls="collapseExample">
                            Connections in common ()
                          </button>
                          <button id="remove_request_btn_" class="btn btn-danger me-1" onclick="removeConnection('{{Auth::user()->id}}','{{$conn->id}}',this);">Remove Connection</button>
                        </div>

                      </div>
                      <div class="collapse" id="collapse_">
                        <div id="content_" class="p-2">
                          <x-connection_in_common />
                        </div>
                        <div id="connections_in_common_skeletons_">
                        </div>
                        <div class="d-flex justify-content-center w-100 py-2">
                          <button class="btn btn-sm btn-primary" id="load_more_connections_in_common_">Load
                            more</button>
                        </div>
                      </div>
                    </div>
                  @endforeach
              </div>
            </div>
        </div>

        <!-- skelton -->
        <div class="d-flex align-items-center  mb-2  text-white bg-dark p-1 shadow d-none " id="skelton" style="height: 45px">
          <strong class="ms-1 text-primary">Loading...</strong>
          <div class="spinner-border ms-auto text-primary me-4" role="status" aria-hidden="true"></div>
        </div>
      </div>
    </div>
  </div>
</div>


