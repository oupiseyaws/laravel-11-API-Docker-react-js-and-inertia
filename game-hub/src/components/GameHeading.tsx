import { Heading } from "@chakra-ui/react";
import { GameQuery } from "../App";
import useGenres from "../hooks/useGenres";
import userPlatform from "../hooks/userPlatform";
import userGerne from "../hooks/useGenre";

interface Props {
  gameQuery: GameQuery;
}

const GameHeading = ({ gameQuery }: Props) => {
  const genre = userGerne(gameQuery.genreId);
  const platform = userPlatform(gameQuery.platformId ?? undefined);
  const heading = `${platform?.name || ""} ${genre?.id || ""} Games`;

  return (
    <Heading as="h1" marginY={5} fontSize="5xl">
      {heading}
    </Heading>
  );
};

export default GameHeading;
