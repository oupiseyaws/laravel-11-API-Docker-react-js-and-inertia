import { useQuery } from "@tanstack/react-query";
import APIClient from "../services/api-client";
import Platforms from "../data/platforms";
import ms from "ms";

const apiClient = new APIClient<Platform>("/platforms/lists/parents");

export interface Platform {
  id: number;
  name: string;
  slug: string;
}

const usePlatforms = () => useQuery({
  queryKey: ["platforms"],
  queryFn: apiClient.getAll,
  staleTime: ms("24h"),
    // cacheTime: 24 * 60 * 60 * 1000, //24h
  initialData: Platforms
})


export default usePlatforms;
