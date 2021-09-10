const express = require('express');
// const { buildSchema } = require('graphql');
const { graphqlHTTP } = require('express-graphql');

const app = express();

app.use(
  '/graphql',
  graphqlHTTP({
    // schema: MyGraphQLSchema,
    graphiql: true,
  }),
);

app.listen(4000);
