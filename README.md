# REST API Tutorials: BUILD REST API and White-Label Services, Right Way to API Development, REST API EXAMPLES
![Build REST API Using Trending Technology](https://github.com/TravelXML/Create-API-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-REST-API/blob/main/images/Build%20REST%20api.png)
### Create REST API with Most Trending Technology - PHP, PYTHON, GO, NodeJS and Most trending frameworks - Django, Laravel, Lumen, GIN
#### What's REST API or RESTFUL API?

**REST is acronym for REpresentational State Transfer**. RESTful API is an architectural style for an **Application Program Interface (API)** that uses **HTTP requests** to access and alter data. That data can be used to **GET, PUT, POST and DELETE** data types, which refers to the **reading, updating, creating and deleting** of operations concerning resources. [For More Details](https://en.wikipedia.org/wiki/Representational_state_transfer)

**The main functions used in any REST-based architecture are:**
- **GET** − Provides read-only access to a resource.
- **PUT** − Creates a new resource.
- **DELETE** − Removes a resource.
- **POST** − Updates an existing resource or creates a new resource.

Your application must satisfy certain constraints or principles. Let's go into details about these principles.

## Principles of REST

There are six ground principles, below are the six guiding principles of REST:

- **Stateless:**
    Requests sent from a client to the server contains all the necessary information that is required to completely understand it. It can be a part of the URI, query-string parameters, body, or even headers. The URI is used for uniquely identifying the resource and the body holds the state of the requesting resource. Once the processing is done by the server, an appropriate response is sent back to the client through headers, status or response body.
 - **Client-Server:** 
    It has a uniform interface that separates the clients from the servers. Separating the concerns helps in improving the user interface’s portability across multiple platforms as well as enhance the scalability of the server components.
    
- **Uniform Interface:**
    To obtain the uniformity throughout the application, REST has defined four interface constraints which are:
    
        Resource identification
        Resource Manipulation using representations
        Self-descriptive messages
        Hypermedia as the engine of application state
- **Cacheable:**
In order to provide a better performance, the applications are often made cacheable. It is done by labeling the response from the server as cacheable or non-cacheable either implicitly or explicitly. If the response is defined as cacheable, then the client cache can reuse the response data for equivalent responses in the future. It also helps in preventing the reuse of the stale data.
    
- **Layered System:**
The layered system architecture allows an application to be more stable by limiting component behavior.  This architecture enables load balancing and provides shared caches for promoting scalability. The layered architecture also helps in enhancing the application’s security as components in each layer cannot interact beyond the next immediate layer they are in.
    
- **Code on Demand:** 
    Code on Demand is an optional constraint and is used the least. It permits a clients code or applets to be downloaded and extended via the interface to be used within the application. In essence, it simplifies the clients by creating a smart application which doesn’t rely on its own code structure.

Now that you know what is a REST API and what all you need to mind in order to deliver an efficient application, let’s dive deeper and see the process of building REST API using all trending technologies and Frameowrks.


## How REST API Different from SOAP?

**REST and Simple Object Access Protocol (SOAP) offer different methods to invoke a web service. REST is an architectural style, while SOAP defines a standard communication protocol specification for XML-based message exchange. REST applications can use SOAP.**

RESTful web services are stateless. A REST-based implementation is simple compared to SOAP, but users must understand the context and content being passed along, as there's no standard set of rules to describe the REST web services interface. REST services are useful for restricted profile devices, such as mobile, and are easy to integrate with existing websites.

SOAP requires less plumbing code meaning low-level, infrastructural code that connects main code modules together than REST services design. The Web Services Description Language describes a common set of rules to define the messages, bindings, operations and location of the service. SOAP web services are useful for asynchronous processing and invocation.

## How to Build a High Performance REST API? and Best Practices

These are some points you have to considering when developing REST API:
* Reduce and limit the Payload Size
* Enable caching
* Provide sufficient Network speed
* Prevent accidental calls, slowdowns, and abuse
* Try to use PATCH over PUT
* Enable Logging, Monitoring, and Alerting
* Enable Pagination

#### 1- Reduce and limit the Payload Size

Extremely large payloads of response data will slow down request completion, other service calls, and in affect degrade performance. As you know, now that we are returning all orders for the customer as opposed to just their current order, we will have to deal with some performance degredation.

**We can use `GZip Compression` to reduce our payload size. This lessens the download size of our response on the web app (client side), as well as increase the upload speed, or creation of some entity (orders). We can use `Deflate compression` on a Web API. Or, we can update the Accept-Encodingrequest header to gzip**.

#### 2- Enable Caching

Caching is one of the easiest methods to improve an API’s performance. If we have requests that frequently give back the same response, then a cached version of that response helps **avoid additional service calls/database queries**.You will want to make sure when using caching to periodically invalidate the data in the cache, especially when new data updates occur.

#### But it may be confusing for you when or where to use cache?

Let’s say our customer wants to place an order for an auto part, and our app calls out to some Auto Parts API to fetch the part price. Since the response (part price) only changes once every week (@ 1:00am), we can cache the response for the rest of the time until then. This saves us from making a new call everytime to return the same part price. Similar case you can use cache to avoid extra calls or requests.

#### 3- Provide Sufficient Network Speed

A slow network will degrade the performance of even the most robustly-designed API. Unreliable networks can cause downtime, which could cause your organization to be in violation of SLAs, terms of service, and promises you may have made to your customers. **It is important to invest in the proper network infrastructure, so that we can maintain the desired level of performance. This can be achieved by leveraging and purchasing sufficient cloud resources and infrastructure `(example: in AWS, allocate the proper # of EC2 instances, use a Network Load Balancer)`**. Also, if you have a large amount of background processes, run those on separate threads to avoid blocking requests. You can also use mirrors, and Content Delivery Networks (CDNs) such as CloudFront to serve requests faster around different parts of the globe.

#### 4- Prevent Accidental Calls, Slowdowns, and Abuse

You can have a situation where your API suffers a DDoS attack that can either be malicious and intentional, or unintenional when an engineer calls the API to execute on a loop from some local application. You can avoid this by measuring transactions, and **`monitoring the number of how many transactions occur per IP Address, or per SSO/JWT Token (if the customer/calling app is authorized before calling the API)`**.

This method to rate-limiting helps reduce excessive requests that would slow the API down, helps deal with accidental calls/executions, and proactively monitor and identify possible malicious activity.

#### 5- Try to use PATCH over PUT

It is a common misconception among engineers that PUT and PATCH operations yield the same result.They are similar in updating resources, but they each perform the updates differently. PUT operations update resources by sending updates to the entire resource. PATCH operations apply partial updates to only the resources that need updating. Resulting inPATCH calls that produce smaller payloads, and improve performance at scale.

       💡Pro-Tip: Even though PATCH calls can limit the request size, you should note that it is not Idempotent. 
        Meaning, it is possible that a PATCHcan yield different results with a series of multiple calls. 
        So, you should carefully and deliberately consider your application for using PATCH requests, 
        and make sure that they are idempotently implemented if needed. If not, use PUT requests.

#### 6- Enable Logging, Monitoring, and Alerting

This is perhaps one of the most important tips you will read here. If there is one thing you should learn from this Repo, it should be this! No negotiation on this one.

**Having logs, monitoring, and alerting help engineers diagnose and remediate issues before they become problems**. Many APIs (Express/Node-based, Java, Go) have predefined endpoints for assessing things like:

    `/health`
    `/metrics`

If you do not have logging enabled, and there is a potential issue going on, you will not be able to track the origin, or where the problem is occurring in a particular request.

If you do not have monitoring enabled, you will not know from an analytical perspective how often some problems or errors are occurring. Which will then prevent you from thinking of possible solutions.

And… if you do not have alerting enabled, you will not know whether there is a problem, UNTIL a customer (or worse, customers) report it. 

#### 7- Enable Pagination

**Pagination helps create buckets of content from multiple responses**. This sort of optimization helps improve responses while preserving the data that is transferred/displayed to a customer. You can standardize, segment, and limit the responses which help reduce complexity of results, and improve the overall customer experience by providing the response/results only for what a customer has asked for.

#### Conclusions

We know that APIs are amazing, and can be extremely powerful in providing the business and customers a great experience, if properly optimized and enhanced for performance.
Business requirements and customer expectations always evolve over time. And as responsible engineers, it is up to us in deciding how to build our APIs in a performant manner, that can help us achieve and exceed our goals.

These tips are just the tip of the iceberg, and apply to all APIs in a general setting. Depending on your particular API and use case, what services it interacts with, how often it gets called, from where it gets called, etc. you might have to implement these tips in different ways.



## You are JUST 5 minutes away to create REST API, what YOU are waiting for? Lets START..

#### How you would like to build? 

  * [REST API with LARAVEL - PASSPORT](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/tree/main/LARAVEL-PASSPORT)  
  * [REST API with PHP - OOPS](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/tree/main/PHP-OOPS)  
  * [REST API with PYTHON - FLASK](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/tree/main/PYTHON)
  * [REST API with PYTHON - DJANGO - RESTFRAMEWORK](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/tree/main/PYTHON-DJANGO-REST-FRAMEWORK)
  * [REST API with GO - MUX](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/tree/main/GOLANG-MUX)  
  
  * [REST API with GO - GIN](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/tree/main/GOLANG-GIN)
  * [REST API with NodeJS - EXPRESS - Basic](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/tree/main/NODEJS-EXPRESS-MYSQL)
  * [REST API with NodeJS - EXPRESS- JWT - SEQUELlZE - Advance](https://github.com/TravelXML/REST-API-WITH-PYTHON-PHP-NODEJS-GO-DJANGO-LARAVEL-LUMEN-Examples/tree/main/NODEJS-EXPRESS-SEQUELlZE-JWT-AUTH)


**Very easy to create REST API in couple of minutes, you can choose any of the above code base according to your language and framework preferences and follow instructions to create REST API.**

Happy Coding 👍

#### For Help, you can reach
-------------------------------

Linkedin: https://www.linkedin.com/in/travel-technology-cto/

Medium: https://apige.medium.com/

Twitter: https://twitter.com/htngapi


