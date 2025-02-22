import { Heading } from "@chakra-ui/react";
import userGerne from "../hooks/useGenre";
import userPlatform from "../hooks/userPlatform";
import userGameQueryStore from "../store";

const GameHeading = () => {
  const genreId = userGameQueryStore((s) => s.gameQuery.genreId);
  const genre = userGerne(genreId);

  const platformId = userGameQueryStore((s) => s.gameQuery.platformId);
  const platform = userPlatform(platformId ?? undefined);

  const heading = `${platform?.name || ""} ${genre?.id || ""} Games`;

  return (
    <Heading as="h1" marginY={5} fontSize="5xl">
      {heading}
    </Heading>
  );
};

export default GameHeading;
