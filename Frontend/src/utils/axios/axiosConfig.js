import axios from 'axios';

const BACKEND_URL = import.meta.env.VITE_BACKEND_URL;
const instance = axios.create(
    {
        baseURL : `${BACKEND_URL}`,
    }
);

export default instance;