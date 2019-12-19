using System;
using System.Collections;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.IO;
using System.Linq;
using System.Web;
using CookComputing.XmlRpc;

namespace BugTrackerXMLRPS
{
    [XmlRpcMissingMapping(MappingAction.Ignore)]
    public class BugTrackerXLMRPS : XmlRpcService
    {
        SqlConnection dbConnection = new SqlConnection("Data Source=localhost;Initial Catalog=DB_BUGTRACKING;Integrated Security=True");
        SqlCommand command;
        struct Depart
        {
            public string IDDep;
            public string NameDep;
            public string PhoneDep;
        }

        struct Emploeey
        {
            public string IDEmpl;
            public string FIO;
            public string Login;
            public string IDDep;
            public string Position;
            public string PhoneEmpl;
            public string E_mail;
        }

        struct Bug
        {
            public string IDBug;
            public string IDProj;
            public string InfoBug;
            public string Priority;
            public string IDEmpl;
            public string Status;
        }

        struct Project
        {
            public string IDProj;
            public string NameProj;
            public string AbbrevProj;
            public string DefenProj;
        }

        //Departments
        [XmlRpcMethod("Departments.Select")]
        public Array SelectDepartments()
        {
            dbConnection.Close();
            ArrayList tabl = new ArrayList();
            Depart row = new Depart();
            command = dbConnection.CreateCommand();
            command.CommandText = "SELECT * FROM Departments";
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            var reader = command.ExecuteReader(CommandBehavior.SingleResult);
            while (reader.Read())
            {
                row.IDDep = reader[0].ToString();
                row.NameDep = reader[1].ToString();
                row.PhoneDep = reader[2].ToString();
                tabl.Add(row);
            }
            return tabl.ToArray();
        }

        [XmlRpcMethod("Departments.Insert")]
        public string InsertDepartmens(string name, int phone)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = $@"INSERT INTO Departments VALUES (@NameDep,@PhoneDep)";
            command.Parameters.AddWithValue("NameDep", name);
            command.Parameters.AddWithValue("PhoneDep", phone);
            command.CommandType = CommandType.Text;
            dbConnection.Open();

            return (command.ExecuteNonQuery() > 0 ? "1" : "0");
        }

        [XmlRpcMethod("Departments.Update")]
        public string UpdateDepartmens(int id, string name, int phone)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = "UPDATE Departments SET NameDep = @NameDep, PhoneDep = @PhoneDep  WHERE IDDep=@ID";
            command.Parameters.AddWithValue("NameDep", name);
            command.Parameters.AddWithValue("PhoneDep", phone);
            command.Parameters.AddWithValue("ID", id);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "1" : "0");
        }

        [XmlRpcMethod("Departments.Delete")]
        public string DeleteDepartmens(int id)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = "Delete Departments WHERE IDDep=@ID";
            command.Parameters.AddWithValue("ID", id);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "1" : "0");
        }

        //Bugs
        [XmlRpcMethod("Bugs.Select")]
        public Array SelectBugs()
        {
            dbConnection.Close();
            ArrayList tabl = new ArrayList();
            Bug row = new Bug();
            command = dbConnection.CreateCommand();
            command.CommandText = "SELECT * FROM Bugs";
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            var reader = command.ExecuteReader(CommandBehavior.SingleResult);
            while (reader.Read())
            {
                row.IDBug = reader[0].ToString();
                row.IDProj = reader[1].ToString();
                row.InfoBug = reader[2].ToString();
                row.Priority = reader[3].ToString();
                row.IDEmpl = reader[4].ToString();
                row.Status = reader[5].ToString();
                tabl.Add(row);
            }
            return tabl.ToArray();
        }

        [XmlRpcMethod("Bugs.Insert")]
        public string InsertBugs(int idproj, string infobug, string priority, int idempl, string status)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = @"INSERT INTO Bugs VALUES (@IDProj,  @InfoBug,  @Priority,  @IDEmpl,  @Status)";
            command.Parameters.AddWithValue("IDProj", idproj);
            command.Parameters.AddWithValue("InfoBug", infobug);
            command.Parameters.AddWithValue("Priority", priority);
            command.Parameters.AddWithValue("IDEmpl", idempl);
            command.Parameters.AddWithValue("Status", status);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "Успешно" : "Ошибка");
        }

        [XmlRpcMethod("Bugs.Update")]
        public string UpdateBugs(int idbug, int idproj, string infobug, string priority, int idempl,string status)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = @"UPDATE Bugs SET IDProj=@IDProj,  InfoBug=@InfoBug, Priority=@Priority, IDEmpl=@IDEmpl, Status=@Status WHERE IDBug=@ID";
            command.Parameters.AddWithValue("IDProj", idproj);

            command.Parameters.AddWithValue("InfoBug", infobug);
            command.Parameters.AddWithValue("Priority", priority);
            command.Parameters.AddWithValue("IDEmpl", idempl);
            command.Parameters.AddWithValue("Status", status);
            command.Parameters.AddWithValue("ID", idbug);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "Успешно" : "Ошибка");
        }

        [XmlRpcMethod("Bugs.Delete")]
        public string DeleteBugs(int id)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = "Delete Bugs WHERE IDBug=@ID";
            command.Parameters.AddWithValue("ID", id);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "1" : "0");
        }

        //Employees
        [XmlRpcMethod("Employees.Select")]
        public Array SelectEmployees()
        {
            dbConnection.Close();
            ArrayList tabl = new ArrayList();
            Emploeey row = new Emploeey();
            command = dbConnection.CreateCommand();
            command.CommandText = "SELECT * FROM Employees";
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            var reader = command.ExecuteReader(CommandBehavior.SingleResult);
            while (reader.Read())
            {
                row.IDEmpl = reader[0].ToString();
                row.FIO = reader[1].ToString();
                row.Login = reader[2].ToString();
                row.IDDep = reader[3].ToString();
                row.Position = reader[4].ToString();
                row.PhoneEmpl = reader[5].ToString();
                row.E_mail = reader[6].ToString();
                tabl.Add(row);
            }
            return tabl.ToArray();
        }

        [XmlRpcMethod("Employees.Insert")]
        public string InsertEmployees(string fio, string login, int iddep, string position, string phoneempl, string email)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = "INSERT INTO Employees VALUES(@FIO, @Login,@IDDep, @Position, @PhoneEmpl, @E_mail)";
            command.Parameters.AddWithValue("FIO", fio);
            command.Parameters.AddWithValue("Login", login);
            command.Parameters.AddWithValue("IDDep", iddep);
            command.Parameters.AddWithValue("Position", position);
            command.Parameters.AddWithValue("PhoneEmpl", phoneempl);
            command.Parameters.AddWithValue("E_mail", email);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "Успешно" : "Ошибка");
        }

        [XmlRpcMethod("Employees.Update")]
        public string UpdateEmployees(int id, string fio, string login, int iddep, string position, string phoneempl, string email)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = "UPDATE Employees SET FIO=@FIO,Login=@Login,IDDep=@IDDep,Position=@Position,PhoneEmpl=@PhoneEmpl,E_mail=@E_mail  WHERE IDEmpl=@ID";
            command.Parameters.AddWithValue("FIO", fio);
            command.Parameters.AddWithValue("Login", login);
            command.Parameters.AddWithValue("IDDep", iddep);
            command.Parameters.AddWithValue("Position", position);
            command.Parameters.AddWithValue("PhoneEmpl", phoneempl);
            command.Parameters.AddWithValue("E_mail", email);
            command.Parameters.AddWithValue("ID", id);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "Успешно" : "Ошибка");
        }

        [XmlRpcMethod("Employees.Delete")]
        public string DeleteEmployees(int id)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = "Delete Employees WHERE IDEmpl=@ID";
            command.Parameters.AddWithValue("ID", id);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "1" : "0");
        }

        //Project
        [XmlRpcMethod("Project.Select")]
        public Array SelectProject()
        {
            dbConnection.Close();
            ArrayList tabl = new ArrayList();
            Project row = new Project();
            command = dbConnection.CreateCommand();
            command.CommandText = "SELECT * FROM Projects";
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            var reader = command.ExecuteReader(CommandBehavior.SingleResult);
            while (reader.Read())
            {
                row.IDProj = reader[0].ToString();
                row.NameProj = reader[1].ToString();
                row.AbbrevProj = reader[2].ToString();
                row.DefenProj = reader[3].ToString();
                tabl.Add(row);
            }
            return tabl.ToArray();
        }

        [XmlRpcMethod("Project.Insert")]
        public string InsertProject(string nameproj, string abbrevproj, string defenproj)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = "INSERT INTO Projects VALUES (@NameProj, @AbbrevProj, @DefenProj)";
            command.Parameters.AddWithValue("NameProj", nameproj);
            command.Parameters.AddWithValue("AbbrevProj", abbrevproj);
            command.Parameters.AddWithValue("DefenProj", defenproj);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "Успешно" : "Ошибка");
        }

        [XmlRpcMethod("Project.Update")]
        public string UpdateProject(int id, string nameproj, string abbrevproj, string defenproj)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = "UPDATE Projects SET NameProj = @NameProj, AbbrevProj = @AbbrevProj, DefenProj = @DefenProj  WHERE IDProj=@ID";
            command.Parameters.AddWithValue("NameProj", nameproj);
            command.Parameters.AddWithValue("AbbrevProj", abbrevproj);
            command.Parameters.AddWithValue("DefenProj", defenproj);
            command.Parameters.AddWithValue("ID", id);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "Успешно" : "Ошибка");
        }

        [XmlRpcMethod("Project.Delete")]
        public string DeleteProject(int id)
        {
            dbConnection.Close();
            command = dbConnection.CreateCommand();
            command.CommandText = "Delete Projects WHERE IDProj=@ID";
            command.Parameters.AddWithValue("ID", id);
            command.CommandType = CommandType.Text;
            dbConnection.Open();
            return (command.ExecuteNonQuery() > 0 ? "1" : "0");
        }
    }
}