<template>
  <div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
Add Room</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Room</h5>
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
    <form @submit.prevent="addRoom" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="Name" v-model="room.name">
        <span>{{ errors.first('name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="no" v-validate="'required'" class="form-control" placeholder="no" v-model="room.no">
        <span>{{ errors.first('no') }}</span>
      </div>
        <button type="submit" class="btn btn-light btn-block">Save</button>
        <button data-dismiss="modal" class="btn btn-danger btn-block">Close</button>

  </form>  
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

    <h2>Rooms</h2>
    
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


      
    
           <tr v-for="room in rooms" v-bind:key="room.id">
      <th scope="row">{{ room.id }}</th>
      <td>{{ room.name }}</td>
      <td>{{ room.no }}</td>
      <td> <button @click="editRoom(room)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteRoom(room.id)" class="btn btn-danger">Delete</button>
      </td>
    
           </tr>
     
  </tbody>
</table>


    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchRooms(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchRooms(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
    
  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      rooms: [],
      room: {
        id: '',
        name: '',
        no: ''
      },
      room_id: '',
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchRooms();
  },
  methods: {
    fetchRooms(page_url) {
      let vm = this;
      page_url = page_url || '../api/rooms';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.rooms = res.data;
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
    deleteRoom(id) {
      if (confirm('Are You Sure?')) {
        fetch(`../api/rooms/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Rooms Removed');
            this.fetchRooms();
          })
          .catch(err => console.log(err));
      }
    },
    addRoom() {
      if (this.edit === false) {
        // Add
        if(this.validation()){
        fetch('../api/rooms', {
          method: 'post',
          body: JSON.stringify(this.room),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Room Added');
            this.fetchRooms();
          })
          .catch(err => console.log(err));}}
       else {
        // Update
        fetch('../api/room', {
          method: 'put',
          body: JSON.stringify(this.room),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Room Updated');
            this.fetchRooms();
          })
          .catch(err => console.log(err));
      }
    },
    editRoom(room) {
      this.edit = true;
      this.room.id = room.id;
      this.room.room_id = room.id;
      this.room.name = room.name;
      this.room.no = room.no;
    },
    clearForm() {
      this.edit = false;
      this.room.name = null;
      this.room.no = null;
    },
    validation(){
      this.verrors = [];
      if(this.room.name === ''){this.verrors.push('Please Add The Room');}
      if(this.room.no === ''){this.verrors.push('Please Add The No');}
      return this.verrors.length > 0 ? false : true;
    }
  }
};
</script>