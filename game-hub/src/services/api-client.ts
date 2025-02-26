import axios, { Axios, AxiosRequestConfig } from "axios";

export interface FetchResponse<T> {
  count: number;
  next: string | null;
  previous: string | null;
  results: T[];
}

const axiosInstance = axios.create({
  baseURL: "https://api.rawg.io/api",
  params: {
    key: "f8e3607080424c63a12e70d9dc506617",
  },
});

class APIClient<T> {
  endpoint: string;

  constructor(endpoint: string) {
    this.endpoint = endpoint;
  }

  getAll = (config: AxiosRequestConfig) => {
    return axiosInstance
      .get<FetchResponse<T>>(this.endpoint, config)
      .then((res) => {
        return res.data;
      });
  }

  get = (id: number|string) => {
    return axiosInstance
      .get<T>(`${this.endpoint}/${id}`)
      .then((res) => {
        return res.data;
      });
  }
}

export default APIClient;
