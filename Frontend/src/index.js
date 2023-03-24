import React from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

import './index.css';
import App from './App';

// set main url
axios.defaults.baseURL = 'http://127.0.0.1:8000/api'
axios.defaults.headers.common['Authorization'] = 'Bearer '+ localStorage.getItem('token');

ReactDOM.render(<App />, document.getElementById('root'));
