<div class="modal fade" id="modalEvent" tabindex="-1" aria-labelledby="modalEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" placeholder="Enter title here..." id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="text">Description</label>
                        <textarea class="form-control" placeholder="Write the event description here..." id="text" name="text" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="isOn_start">Start Time</label>
                        <input type="datetime-local" class="form-control" id="isOn_start" name="isOn_start" required>
                    </div>
                    <div class="form-group">
                        <label for="isOn_end">End Time</label>
                        <input type="datetime-local" class="form-control" id="isOn_end" name="isOn_end" required>
                    </div>
                    <input type="hidden" name="type" value="event">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
