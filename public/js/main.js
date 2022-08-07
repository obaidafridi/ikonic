var skeletonId = 'skeleton';
var contentId = 'content';
var skipCounter = 0;
var takeAmount = 10;


function getRequests(mode) {
  // your code here...
}

function getMoreRequests(mode) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnections() {
  // your code here...
}

function getMoreConnections() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnectionsInCommon(userId, connectionId) {
  // your code here...
}

function getMoreConnectionsInCommon(userId, connectionId) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getMoreSuggestions() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

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

