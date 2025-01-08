import axios from "axios";

export default axios.create({
  baseURL: "https://api.rawg.io/api",
  params: {
    key: "f8e3607080424c63a12e70d9dc506617",
  },
});
