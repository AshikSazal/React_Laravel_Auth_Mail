import React, { Component } from "react";
import { Link } from "react-router-dom";
import axios from "axios";

class Navbar extends Component {
  state = {
    loggedout: "",
  };

  logout = () => {
    // console.log(this.props.user);
    axios.post("/logout",this.props.user)
      .then((response) => {
        localStorage.clear();
        this.props.setUser(null);
      })
      .catch((error) => {
        console.log(error);
      });
  };

  render() {
    let buttons;
    let profile;

    if (localStorage.getItem("token")) {
      buttons = (
        <div>
          <Link class="nav-link" to="/" onClick={this.logout}>
            Logout
          </Link>
        </div>
      );
      profile = (
        <div>
          <Link class="nav-link" to="/profile">
            Profile
          </Link>
        </div>
      );
    } else {
      buttons = (
        <div>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <Link class="nav-link" to="/login">
                Login
              </Link>
            </li>
            <li class="nav-item">
              <Link class="nav-link" to="/register">
                Register
              </Link>
            </li>
          </ul>
        </div>
      );
    }

    return (
      <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg-dark navbar-dark">
          <Link class="navbar-brand" to="/">
            Authentication
          </Link>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarText"
            aria-controls="navbarText"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <Link class="nav-link active" aria-current="page" to="/">
                  Home
                </Link>
              </li>
              <li class="nav-item">{profile}</li>
            </ul>
            <span class="navbar-text">{buttons}</span>
          </div>
        </nav>
      </div>
    );
  }
}

export default Navbar;
