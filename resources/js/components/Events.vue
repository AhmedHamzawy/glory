<template>
  <div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add New Event
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p v-if="verrors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in verrors" :key="error">{{ error }}</li>
    </ul>
    </p>
    <form @submit.prevent="addEvent" class="mb-3">
      <div class="form-group">
        <input type="text" name="title" v-validate="'required'" class="form-control" placeholder="Title" v-model="event.title">
        <span>{{ errors.first('title') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="url" v-validate="'required'" class="form-control" placeholder="URL" v-model="event.url">
        <span>{{ errors.first('url') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="start" v-validate="'required'" class="form-control" placeholder="Start" v-model="event.start">
        <span>{{ errors.first('start') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="end" v-validate="'required'" class="form-control" placeholder="End" v-model="event.end">
        <span>{{ errors.first('end') }}</span>
      </div>
      <button type="submit" class="btn btn-light btn-block">Save</button>
    </form>
    <button @click="clearForm()" class="btn btn-danger btn-block">Cancel</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <h2>Events</h2>
    
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>


      
    
           <tr v-for="event in events" v-bind:key="event.id">
      <th scope="row">{{ event.id }}</th>
      <td>{{ event.title }}</td>
      <td>{{ event.url }}</td>
      <td>{{ event.start }}</td>
      <td>{{ event.end }}</td>
      <td> <button @click="editEvent(event)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteEvent(event.id)" class="btn btn-danger">Delete</button>
      </td>
    
           </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchEvents(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchEvents(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      events: [],
      event: {
        id: '',
        title: '',
        body: ''
      },
      event_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchEvents();
  },
  methods: {
    fetchEvents(page_url) {
      let vm = this;
      page_url = page_url || '../api/events';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.events = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },
    deleteEvent(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../public/api/events/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Event Removed');
            this.fetchEvents();
          })
          .catch(err => console.log(err));
      }
    },
    addEvent() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../public/api/events', {
          method: 'post',
          body: JSON.stringify(this.event),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Event Added');
            this.fetchEvents();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/event', {
          method: 'put',
          body: JSON.stringify(this.event),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Event Updated');
            this.fetchEvents();
          })
          .catch(err => console.log(err));
      }
    },
    editEvent(event) {
      this.edit = true;
      this.event.id = event.id;
      this.event.event_id = event.id;
      this.event.title = event.title;
      this.event.url = event.url;
      this.event.start = event.start;
      this.event.end = event.end;
    },
    clearForm() {
      this.edit = false;
      this.event.id = null;
      this.event.event_id = null;
      this.event.title = '';
      this.event.url = '';
      this.event.start = '';
      this.event.end = '';
    },
    validation(){
      this.verrors = [];
      if(this.event.title === ''){this.verrors.push('Please Add The Title');}
      if(this.event.url === ''){this.verrors.push('Please Add The Body');}
      if(this.event.start === ''){this.verrors.push('Please Add The Body');}
      if(this.event.end === ''){this.verrors.push('Please Add The Body');}
      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>