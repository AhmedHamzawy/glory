<template>
  <div>

    <p v-if="verrors.length">
    <b>Please correct the following error(s):</b>
    <ul>
      <li v-for="error in verrors" :key="error">{{ error }}</li>
    </ul>
    </p>
    <form @submit.prevent="editSettings" class="mb-3">
      <div class="form-group">
        <input type="text" name="name" v-validate="'required'" class="form-control" placeholder="Name" v-model="setting.name">
        <span>{{ errors.first('name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="address" v-validate="'required'" class="form-control" placeholder="Address" v-model="setting.address">
        <span>{{ errors.first('address') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="town" v-validate="'required'" class="form-control" placeholder="Town" v-model="setting.town">
        <span>{{ errors.first('middle_name') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="county" v-validate="'required'" class="form-control" placeholder="County" v-model="setting.county">
        <span>{{ errors.first('county') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="post_code" v-validate="'required'" class="form-control" placeholder="Gender" v-model="setting.post_code">
        <span>{{ errors.first('post_code') }}</span>
      </div>
       <div class="form-group">
        <select v-model="setting.country">
          <option v-for="country in countries" v-bind:key="country.id" :value="country.id">
            {{ country.name }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <input type="text" name="telephone" v-validate="'required'" class="form-control" placeholder="Telephone" v-model="setting.telephone">
        <span>{{ errors.first('telephone') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="email" v-validate="'required'" class="form-control" placeholder="Email" v-model="setting.email">
        <span>{{ errors.first('email') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="website" v-validate="'required'" class="form-control" placeholder="Website" v-model="setting.website">
        <span>{{ errors.first('website') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="facebook" v-validate="'required'" class="form-control" placeholder="Facebook" v-model="setting.email">
        <span>{{ errors.first('facebook') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="twitter" v-validate="'required'" class="form-control" placeholder="Twitter" v-model="setting.twitter">
        <span>{{ errors.first('twitter') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="instgram" v-validate="'required'" class="form-control" placeholder="Instgram" v-model="setting.instgram">
        <span>{{ errors.first('instgram') }}</span>
      </div>
      <div class="form-group">
        <input type="text" name="youtube" v-validate="'required'" class="form-control" placeholder="Youtube" v-model="setting.youtube">
        <span>{{ errors.first('youtube') }}</span>
      </div>
     
      
      
      <button type="submit" class="btn btn-light btn-block">Save</button>
    </form>
    <button @click="clearForm()" class="btn btn-danger btn-block">Cancel</button>

  </div>
</template>

<script>
export default {
  data() {
    return {
      verrors: [],
      settings: [],
      countries: [],
      setting: {
        id: '',
        name: '',
        address: '',
        town: '',
        county: '',
        post_code: '',
        country: '',
        telephone: '',
        email: '',
        website: '',
        facebook: '',
        twitter: '',
        instagram: '',
        youtube: '',
     
      },
      pagination: {},
      edit: false
    };
  },
  created() {
    this.fetchSettings();
    this.fetchCountries();
  },
  methods: {
    fetchSettings(settings_url) {
      settings_url = settings_url || '../api/settings';
      fetch(settings_url)
        .then(res => res.json())
        .then(res => {
          this.settings = res.data;
        })
        .catch(err => console.log(err));
    },
    fetchCountries(countries_url){
      countries_url =  countries_url || '../api/countries';
      fetch(countries_url)
        .then(res => res.json())
        .then(res => {
          this.countries = res;
        })
        .catch(err => console.log(err));
    },
    editSettings() {
        // Update
        fetch('../api/settings', {
          method: 'put',
          body: JSON.stringify(this.user),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('User Updated');
            this.fetchSettings();
          })
          .catch(err => console.log(err));
      }
    },
    editUser(setting) {
      this.edit = true;
      this.setting.id = user.id;
      this.setting.name = setting.name;
      this.setting.address = setting.address;
      this.setting.town = setting.town;
      this.setting.county = setting.county;
      this.setting.post_code = setting.post_code;
      this.setting.country = setting.country;
      this.setting.telephone = setting.telephone;
      this.setting.email = setting.email;
      this.setting.website = setting.website;
      this.setting.facebook = setting.facebook;
      this.setting.twitter = setting.twitter;
      this.setting.instagram = setting.instagram;
      this.setting.youtube = setting.youtube;
     

      
    },
    validation(){
      this.verrors = [];
      if(this.setting.name === ''){this.verrors.push('This Field Can\'t Be Deleted');}
      if(this.setting.address === ''){this.verrors.push('This Field Can\'t Be Deleted');}
      if(this.setting.town === ''){this.verrors.push('This Field Can\'t Be Deleted');}
      if(this.setting.county === ''){this.verrors.push('This Field Can\'t Be Deleted');}
      if(this.setting.post_code === ''){this.verrors.push('This Field Can\'t Be Deleted');}
      if(this.setting.country === ''){this.verrors.push('This Field Can\'t Be Deleted');}
      if(this.setting.telephone === ''){this.verrors.push('This Field Can\'t Be Deleted');}
      if(this.setting.email === ''){this.verrors.push('This Field Can\'t Be Deleted');}
      if(this.setting.website === ''){this.verrors.push('This Field Can\'t Be Deleted');}
      

      return this.verrors.length > 0 ? false : true;
    }
  }
</script>