import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import GoogleLogin from 'react-google-login';

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

  responseGoogle(response) {
    console.log(response);
    if (response.error) {
      this.setState({
        error: 'go fuck yourself'
      });
    }
    else {
      this.setState({
        user: response.WE
      });
    }
  }

  render() {
    const user = this.state.user;
    const loggedIn = <div className="App">
        <h1> SNACK TRACKER </h1>
      </div>;

    const login = <div>
        <div className="App">
            <h1> SNACK TRACKER </h1>
        </div>
        <GoogleLogin
          clientId="658977310896-knrl3gka66fldh83dao2rhgbblmd4un9.apps.googleusercontent.com"
          buttonText="Login"
          onSuccess={this.responseGoogle}
          onFailure={this.responseGoogle}
        />
      </div>;

    return user != null ? loggedIn : login;
  }
}

export default App;
