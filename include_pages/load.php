
<div id="load_popup_modal_contant" class="text-left" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Open Ticket </h4><div id="opntkt_sub_response"></div>
      </div>
      <div class="modal-body">
        <form method="post" id="openticketform">
           <div class="form-group">
            <label for="message-text" class="control-label">Subject:</label>
            <input type="text" class="form-control" name="ticketsubject" id="ticketsub_load" required/> 
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Priority:</label>
            
            <select name="inputpriority" id="inputpriority_load" class="form-control" required>
                <option value="High">
                    High
                </option>
                <option value="Medium" selected="selected">
                    Medium
                </option>
                <option value="Low">
                    Low
                </option>
            </select>            
            
            
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" name="ticketmessage" id="ticketmessage_load" required></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default" id="closesection" data-dismiss="modal">Close</button>
        <input type="button" onclick="submitopenticket();" name="submitopen" class="btn bg-info-400" value="Open Ticket"> 
      </div>
        </form>
         
      </div>
     
    </div>
  </div>
</div>      