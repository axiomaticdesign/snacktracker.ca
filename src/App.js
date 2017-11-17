import React, { Component } from 'react';
import './App.css';
import GoogleLogin from 'react-google-login';
import Snack from 'snack';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      user: null,
      error: null,
    }
  }

  componentDidMount() {
    //check if they are logged in
  }

  responseGoogle = (response) => {
    console.log(response);
    if (response.error) {
      this.setState({
        error: 'go fuck yourself'
      });
      console.log('error')
    }
    else {
      this.setState({
        user: response
      });
      this.getProducts();
      console.log('weeee')
    }
  }

  getProducts = () => {
    fetch('/api/handlers/products/products.php')
      .then(res => {
        console.log(res)
      })
  }

  render() {
    const { user, error } = this.state;
    const loggedIn = (
      <div className="App">
        <h1>{ user && `Hello ${user.w3.ig}` }</h1>
        <snack></snack>
      </div>
    );

    const login = (
      <div>
        <div className="App">
            <h1>{ error || 'Please login' }</h1>
        </div>
        <GoogleLogin
          clientId="658977310896-knrl3gka66fldh83dao2rhgbblmd4un9.apps.googleusercontent.com"
          buttonText="Login"
          onSuccess={this.responseGoogle}
          onFailure={this.responseGoogle}
        />
      </div>
    );

    console.log(user)

    return user != null ? loggedIn : login;
  }
}

export default App;
