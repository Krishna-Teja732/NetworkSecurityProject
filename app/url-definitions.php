<?php

# URL paths for webpage 
const LOGIN = "/login";
const SIGNUP = "/signup";
const HOME = "/home";
const MY_PROFILE = "/profile";
const OTHER_USER_PROFILE = "/profile/u/";
const TRANSACTIONS = "/transactions";

# API paths
const LOGIN_HANDLER = "/api/login-handler";
const SIGNUP_HANDLER = "/api/signup-handler";
const PROFILE_PICTURE_UPDATE_HANDLER = "/api/update-profile-picture";
const LOGOUT_HANDLER = "/api/logout-handler";

# Paths that do not need authentication 
const UNAUTHENTICATED_URL_LIST = [LOGIN, LOGIN_HANDLER, SIGNUP, SIGNUP_HANDLER];
