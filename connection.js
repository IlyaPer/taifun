const mysql = require('mysql');

const conn = mysql.CreateConnection({
  host: "localhost",
  user: "root",
  database: "taifun",
  password: ""
});

conn.connect(
  err => {
    if (err) {
      console.log(err);
      return err;
    }
    else {
      console.log('Connection to database was made.')
    }
  }
)
