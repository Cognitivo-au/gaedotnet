using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using GoogleCloudAspNetCore.testapp.Models;
using System.ComponentModel.DataAnnotations;
using MailKit.Net.Smtp;
using MimeKit;
using System.Text;



namespace GoogleCloudAspNetCore_testapp.Controllers
{
    public class HomeController : Controller
    {
        public IActionResult Index()
        {
            return View();
        }

        public IActionResult About()
        {
            ViewData["Message"] = "Your application description page.";

            return View();
        }

        public IActionResult Skills()
        {
            ViewData["Message"] = "Your skills description page.";

            return View();
        }

        public IActionResult team()
        {
            ViewData["Message"] = "Your team description page.";

            return View();
        }
    

        public IActionResult Error()
        {
            return View();
        }

        public IActionResult Success()
        {
            return View();
        }


        public IActionResult Contact()
        {
            return View();
        }
        public IActionResult Resources()
        {
            return View();
        }

        
        [HttpPost]
        public ActionResult Contact(ContactModels c)
        {
            if (ModelState.IsValid)
            {
                try
                {


                    // From Address
                    string FromAddress = "Vinay.samineni@cognitivo.com.au";
                    string FromAdressTitle = "web contact";
                    //To Address
                    string ToAddress = "alan.hsiao@cognitivo.com.au";
                    string ToAdressTitle = "Web contact";
                    string Subject = "Web contact";
                    StringBuilder sb = new StringBuilder();
                    sb.Append("First name: " + c.FirstName);
                    sb.Append(Environment.NewLine);
                    sb.Append("Last name: " + c.LastName);
                    sb.Append(Environment.NewLine);
                    sb.Append("Email: " + c.Email);
                    sb.Append(Environment.NewLine);
                    sb.Append("Comments: " + c.Comment);


                    string BodyContent = sb.ToString();

                    //Smtp Server
                    string SmtpServer = "smtp.gmail.com";
                    //Smtp Port Number
                    int SmtpPortNumber = 587;

                    var mimeMessage = new MimeMessage();
                    mimeMessage.From.Add(new MailboxAddress(FromAdressTitle, FromAddress));
                    mimeMessage.To.Add(new MailboxAddress(ToAdressTitle, ToAddress));
                    mimeMessage.Subject = Subject;
                    mimeMessage.Body = new TextPart("plain")
                    {
                        Text = BodyContent

                    };

                    using (var client = new SmtpClient())
                    {

                        client.Connect(SmtpServer, SmtpPortNumber, false);
                        // Note: only needed if the SMTP server requires authentication
                        // Error 5.5.1 Authentication 
                        client.Authenticate("vinay.samineni@gmail.com", "ganesh00");
                        client.Send(mimeMessage);
                        client.Disconnect(true);
                        return View("Index");
                    }
                    /* MailMessage msg = new System.Net.Mail.MailMessage();
                    SmtpClient smtp = new SmtpClient();
                    MailAddress from = new MailAddress(c.Email.ToString());
                    StringBuilder sb = new StringBuilder();
                    msg.To.Add("youremail@email.com");
                    msg.Subject = "Contact Us";
                    msg.IsBodyHtml = false;

                    client.Host = "smtp.gmail.com";
                    client.Port = 587;
                    client.EnableSsl = true;
                    client.DeliveryMethod = SmtpDeliveryMethod.Network;
                    client.Credentials = new System.Net.NetworkCredential("vinay.samineni@cognitivo.com.au", "ganesh00");

                    sb.Append("First name: " + c.FirstName);
                    sb.Append(Environment.NewLine);
                    sb.Append("Last name: " + c.LastName);
                    sb.Append(Environment.NewLine);
                    sb.Append("Email: " + c.Email);
                    sb.Append(Environment.NewLine);
                    sb.Append("Comments: " + c.Comment);
                    msg.Body = sb.ToString();
                    smtp.Send(msg);
                    msg.Dispose();
                    return View("Success");*/

                }
                catch (Exception)
                {
                    return View("Error");
                }
            }
            else
            {
                return View();
            }
            return View();
        }
    }
}
