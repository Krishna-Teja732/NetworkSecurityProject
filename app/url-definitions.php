<?php

# URL paths for webpage 
const LOGIN = "/login";
const SIGNUP = "/signup";
const HOME = "/home";
const MY_PROFILE = "/profile";
const OTHER_USER_PROFILE = "/profile/u/";
const SEARCH_USERS = "/users";
const TRANSFER = "/transfer";

# API paths
const SIGNUP_HANDLER = "/api/signup-handler";
const LOGIN_HANDLER = "/api/login-handler";
const LOGOUT_HANDLER = "/api/logout-handler";
const PROFILE_PICTURE_UPDATE_HANDLER = "/api/update-profile-picture";
const EMAIL_UPDATE_HANDLER = "/api/update-email";
const DESCRIPTION_UPDATE_HANDLER  = "/api/update-description";
const GET_PROFILE_PICTURE = "/picture/";
const CREATE_TRANSACTION = "/api/create-transaction";
const UPLOAD_FILE_HANDLER = "/api/upload-file";
const DOWNLOAD_FILE_HANDLER = "/api/download-file";

# Paths that do not need authentication 
const UNAUTHENTICATED_URL_LIST = [LOGIN, LOGIN_HANDLER, SIGNUP, SIGNUP_HANDLER];
const AUTHENTICATED_URL_LIST = [HOME, MY_PROFILE, SEARCH_USERS, TRANSFER];
