import useGenres from "./useGenres";

const userGerne = (id?: number) => {
    const { data: genres } = useGenres();
    return genres?.results.find((g) => g.id === id);
}
export default userGerne;