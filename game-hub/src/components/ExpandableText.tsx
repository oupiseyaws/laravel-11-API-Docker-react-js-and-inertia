import React, { Children, useState } from "react";
import { Button, Text } from "@chakra-ui/react";
interface Props {
  children: string;
}
const ExpandableText = ({ children }: Props) => {
  const [expanded, setExpanded] = useState(false);
  const limit = 100;

  if (!children) return null;

  if (children.length < limit) return <div>{children}; </div>;

  const summary = expanded ? children : children.slice(0, limit) + "...";

  return (
    <Text>
      {summary}
      <Button
        marginLeft={2}
        size="xs"
        fontWeight="bold"
        color="blue.500"
        onClick={() => setExpanded(!expanded)}
      >
        {expanded ? "Show less" : "Show more"}
      </Button>
    </Text>
  );
};

export default ExpandableText;
