import { create } from 'zustand';

export interface GameQuery {
    genreId?: number;
    platformId?: number | null;
    sortOrder?: string;
    searchText?: string;
}

interface GameQueryStore{
    gameQuery: GameQuery;
    setSearchText: (searchText: string) => void;
    setGenreId: (genreId: number) => void;
    setPlatformId: (platformId: number) => void;
    setSortOrder: (sortOrder: string) => void;
}

const userGameQueryStore = create<GameQueryStore>((set) => ({
    gameQuery: {},
    setSearchText: (searchText) => set(()  => ({ gameQuery: {  searchText } })),
    setGenreId: (genreId)       => set((state)  => ({ ...state, gameQuery: { ...state.gameQuery, genreId } })),
    setPlatformId: (platformId) => set((state)  => ({ ...state, gameQuery: { ...state.gameQuery, platformId } })),
    setSortOrder: (sortOrder)   => set((state)  => ({ ...state, gameQuery: { ...state.gameQuery, sortOrder } })),
}));

export default userGameQueryStore;
