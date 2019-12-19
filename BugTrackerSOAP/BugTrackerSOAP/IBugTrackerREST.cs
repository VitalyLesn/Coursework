using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;

namespace BugTrackerSOAP
{
    [ServiceContract]
    public interface IBugTrackerREST
    {

        [WebGet(UriTemplate = "/Departments")]
        [OperationContract]
        string SelectDepartments();

        //[OperationContract]
        //string InsertDepartmens(string name, int phone);

        //[OperationContract]
        //string UpdateDepartmens(int id, string name, int phone);

        //[OperationContract]
        //string DeleteDepartmens(int id);

        //[OperationContract]
        //string DeleteBugs(int id);

        //[OperationContract]
        //[WebInvoke(Method = "GET", UriTemplate = "Bug")]
        //string SelectBugs();

        //[OperationContract]
        //string InsertBugs(int idproj, string infobug, string priority, int idempl, string status);

        //[OperationContract]
        //string UpdateBugs(int idbug, int idproj, string infobug, string priority, int idempl, string status);

        //[OperationContract]
        //[WebInvoke(Method = "GET", UriTemplate = "Project")]
        //string SelectProject();

        //[OperationContract]
        //string InsertProject(string nameproj, string abbrevproj, string defenproj);

        //[OperationContract]
        //string UpdateProject(int id, string nameproj, string abbrevproj, string defenproj);

        //[OperationContract]
        //string DeleteProject(int id);

        //[OperationContract]
        //[WebInvoke(Method = "GET", UriTemplate = "Employees")]
        //string SelectEmployees();

        //[OperationContract]
        //string InsertEmployees(string fio, string login, int iddep, string position, string phoneempl, string email);

        //[OperationContract]
        //string UpdateEmployees(int id, string fio, string login, int iddep, string position, string phoneempl, string email);

        //[OperationContract]
        //string DeleteEmployees(int id);

    }
}
