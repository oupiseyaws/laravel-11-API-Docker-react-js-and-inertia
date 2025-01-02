import { useQuery } from "@tanstack/react-query";
import axios from "axios";

interface Post {
    id: number;
    title: string;
    body: string;
    userId: number;
  }

const usePosts = (userID : number | undefined) => {
    const fetchTodos = () =>
        axios
        .get("https://jsonplaceholder.typicode.com/posts",{
            params: {
                userId: userID,
            },
        })
        .then((res) => res.data);

    return useQuery  <Post[], Error>({
        queryKey: userID ? ["users",userID,"posts"] : ["posts"],
        queryFn: fetchTodos,
        staleTime: 1 * 60 * 1000, // 1 minute
    });
}

export default usePosts;
