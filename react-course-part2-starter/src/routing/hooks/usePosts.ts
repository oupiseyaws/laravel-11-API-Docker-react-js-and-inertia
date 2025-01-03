import { useInfiniteQuery, useQuery } from "@tanstack/react-query";
import axios from "axios";

interface Post {
    id: number;
    title: string;
    body: string;
    userId: number;
}

interface postQuery {
    pageSize: number;
}

const usePosts = (query: postQuery ) => 
     useInfiniteQuery <Post[], Error>({
        queryKey: ["posts", query],
        queryFn: ({ pageParam = 1 }) =>
            axios
            .get("https://jsonplaceholder.typicode.com/posts",{
                params: {
                    _start: (pageParam - 1) * query.pageSize,
                    _limit: query.pageSize,
                },
            })
            .then((res) => res.data),
        staleTime: 1 * 60 * 1000, // 1 minute
        keepPreviousData: true,
        getNextPageParam: (lastPage, allPages) => {
            if (lastPage.length < query.pageSize) {
                return undefined;
            }
            return allPages.length + 1
        },
    });

export default usePosts;
