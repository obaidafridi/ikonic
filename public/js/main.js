
//i have not used breez component i can all these things with livewire as well but shortage of time i have use simple javascript jqeuery
//these 4 main functions

function sendRequest(userId, requestId,el) {
  let connectionArray=[userId,requestId,el,'sendRequest'];
  exampleUseOfAjaxFunction(connectionArray);
}

function deleteRequest(userId, requestId,el) {
  let connectionArray=[userId,requestId,el,'deleteRequest'];
  exampleUseOfAjaxFunction(connectionArray);
}

function acceptRequest(userId, requestId,el) {
  let connectionArray=[userId,requestId,el,'acceptRequest'];
  exampleUseOfAjaxFunction(connectionArray);
}

function removeConnection(userId, connectionId,el) {
  let connectionArray=[userId,connectionId,el,'removeConnected'];
  exampleUseOfAjaxFunction(connectionArray);
}

